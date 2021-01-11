<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecurringQuotationIsExpiringSoon;

class QuotationService {

    /**
     * Generate a export PDF for a quotation
     * 
     * @param Quotation $quotation
     * @return Stream 
     */
    public function generatePDF($quotation) 
    {
        $pdf = \PDF::loadView('templates.quotations.pdf_export', [
            'quotation' => $quotation,
            'due_date' => new Carbon($quotation->quotation_date),
            'creation_date'=> new Carbon($quotation->expiry_date),
            'title' => 'Cotizacion',
        ]);

        return $pdf->stream('invoice.pdf');
    }

    /**
     * Search all recurrent quotations and generate the next quotation base on the "Next due date" field. This function is 
     * meant to be on a daily cron job
     * 
     * @param Carbon $date
     * @param array $quotationsArrayId 
     * @return void
     */
    public function generateRecurrentQuotations(Carbon $date = null, $quotationsArrayId = null)
    {
        if ($date === null) $date = new Carbon();

        // Buscar todas las cotizaciones recurrentes con estado aprobada
        $quotations = Quotation::where([
                'quotation_status' => Quotation::STATUS_ACCEPTED, 
                'is_recurring' => true ])
                ->with('childrens');
        
        if ($quotationsArrayId !== null && !empty($quotationsArrayId)) {
            $quotations = $quotations->whereIn('id', $quotationsArrayId);
        }

        $quotations = $quotations->get();

        foreach ($quotations as $quotation) {

            DB::beginTransaction();

            try {
                $recurringData = $quotation->recurring_data;

                // Verificar criterio de parada
                if ($recurringData['end_type'] === 'date') {
                    $endDate = new Carbon($recurringData['end_date']);

                    if ($date->startOfDay() > $endDate->startOfDay()) {
                        $quotation->quotation_status = Quotation::STATUS_COMPLETED;
                        $quotation->updateWithoutEvents();
                        DB::commit();
                        continue;
                    }
                } else if ($recurringData['end_type'] === 'repetition') {
                    if (intval($recurringData['end_after_reps']) <= $quotation->childrens->count()) {
                        $quotation->quotation_status = Quotation::STATUS_COMPLETED;
                        $quotation->updateWithoutEvents();
                        DB::commit();
                        continue;
                    }
                }

                $this->sendMailIfQuotationCloseToExpire($quotation, $date);

                // Ver la fecha indicada en "next due date" y verificar que sea igual a la fecha actual
                $nextDueDate = new Carbon($quotation->next_due_date);

                if ($nextDueDate->format('Y-m-d') !== $date->format('Y-m-d')) {
                    DB::commit();
                    continue;
                }

                // Revisar que no exista una cotizacion hija ese dia
                if ($this->existChildrenQuotationOnDate($quotation->childrens, $date)) {
                    DB::commit();
                    continue;
                }

                // Crear una nueva cotizacion hija
                $newQuotation = new Quotation($quotation->toArray());
                $newQuotation->quotation_date = $date;
                $newQuotation->parent_id = $quotation->id;
                $newQuotation->items_data = $quotation->items_data;
                $newQuotation->is_recurring = false;
                $newQuotation->quotation_status = Quotation::STATUS_PENDING_PAYMENT;

                // TODO revisar que otros campos eliminar
                unset($newQuotation->expiry_date);
                unset($newQuotation->code);
                unset($newQuotation->recurring_data);
                unset($newQuotation->next_due_date);
                
                $newQuotation->save();

                // Modificar "next due date" de la cotizacion padre sumando el ciclo de recurrencia
                $newNextDueDate = $nextDueDate->add(intval($recurringData['repeat_number']), $recurringData['repeat_every']);
                $quotation->next_due_date = $newNextDueDate;


                // Comparar nueva next due date con el parametro de parada
                if ($recurringData['end_type'] === 'date') {
                    if ($newNextDueDate->startOfDay() > $endDate->startOfDay()) {
                        $quotation->quotation_status = Quotation::STATUS_COMPLETED;
                    }
                } else if ($recurringData['end_type'] === 'repetition') {
                    if (intval($recurringData['end_after_reps']) <= ($quotation->childrens->count() + 1)) {
                        $quotation->quotation_status = Quotation::STATUS_COMPLETED;
                    }
                }
                
                $quotation->updateWithoutEvents();

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                Log::error($e->getMessage(), [ 'quotation_id' => $quotation->id]);
            }
        }
    }


    public function existChildrenQuotationOnDate($childrens, Carbon $date)
    {
        $exits = false;

        foreach ($childrens as $child) {
            $childDate = new Carbon($child->created_at);
            if ($childDate->format('Y-m-d') === $date->format('Y-m-d')) $exits = true;
        }

        return $exits;
    }

    /**
     * Returns the remaining days from the specified date until a recurring quotation reaches its next due date 
     * 
     * @param Quotation $quotation
     * @param Carbon $date
     * @return Int 
     */
    public function daysUntilQuotationNextDueDate(Quotation $quotation, Carbon $date = null )
    {
        if ($date === null) $date = new Carbon();

        $nextDueDate = new Carbon($quotation->next_due_date);

        return $date->startOfDay()->diffInDays($nextDueDate->startOfDay());
    }

    /**
     * Check if a recurring quotation is close to expiring according to the configuration of the company and send 
     * an email if the above is true
     * 
     * @param Quotation $quotation
     * @param Carbon $date
     * @return void
     */
    public function sendMailIfQuotationCloseToExpire(Quotation $quotation, Carbon $date = null)
    {
        if ($date === null) $date = new Carbon();

        $daysUntilExpires = $this->daysUntilQuotationNextDueDate($quotation, $date);
        $companyDaysBeforeParam = $quotation->firstCompany()->days_before_quotation_expires;

        if ($daysUntilExpires ===  $companyDaysBeforeParam && $companyDaysBeforeParam !== 0) {
            Mail::to($quotation->customer->email)->send(new RecurringQuotationIsExpiringSoon($quotation));
        }
    }

    /**
     * Not in used
     */
    public function daysUntilQuotationExpires(Quotation $quotation, Carbon $date = null )
    {
        if ($date === null) $date = new Carbon();

        if ($quotation->recurring_data['end_type'] === 'never') return 0;

        if ($quotation->recurring_data['end_type'] === 'date') {
            $endDate = new Carbon($quotation->recurring_data['end_date']);
            return $date->startOfDay()->diffInDays($endDate->startOfDay());
        }

        if ($quotation->recurring_data['end_type'] === 'repetition') {
            $endDate = new Carbon($quotation->recurring_data['start_date']);
            
            for ($i = 0; $i < $quotation->recurring_data['end_after_reps']; $i++) {
                $endDate->add(intval($quotation->recurring_data['repeat_number']), $quotation->recurring_data['repeat_every']);
            }

            return $date->startOfDay()->diffInDays($endDate->startOfDay());
        }
    }

}

?>