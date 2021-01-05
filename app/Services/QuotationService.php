<?php

namespace App\Services\Quiotations;

use Exception;
use Carbon\Carbon;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuotationService {

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
        if (is_null($date)) $date = new Carbon();

        // Buscar todas las cotizaciones recurrentes con estado aprobada
        $quotations = Quotation::where([
                'quotation_status' => Quotation::STATUS_ACCEPTED, 
                'is_recurring' => true ])->with('childrens');
        
        if (!is_null($quotationsArrayId) && !empty($quotationsArrayId)) {
            $quotations = $quotations->whereIn('id', $quotationsArrayId);
        }

        $quotations = $quotations->get();
        foreach ($quotations as $quotation) {

            DB::beginTransaction();

            try {
                $recurringData = $quotation->recurring_data;

                // Verificar criterio de parada
                // Si el criterio de parada se cumple, cambiar el estado de la cotizacion
                if ($recurringData['end_type'] === 'date') {
                    $endDate = new Carbon($recurringData['end_date']);
                    if ($date > $endDate) {
                        $quotation->quotation_status = 'Completada'; // Que estado cambiar?
                        $quotation->updateWithoutEvents();
                        DB::commit();
                        continue;
                    }
                } else if ($recurringData['end_type'] === 'repetition') {
                    if (intval($recurringData['end_after_reps']) <= $quotation->childrens->count()) {
                        $quotation->quotation_status = 'Completada'; // Que estado cambiar?
                        $quotation->updateWithoutEvents();
                        DB::commit();
                        continue;
                    }
                }

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

                // Si la comprobacion anterior es true, crear una nueva cotizacion hija
                $newQuotation = new Quotation($quotation->toArray());
                $newQuotation->parent_id = $quotation->id;
                $newQuotation->items_data = $quotation->items_data;
                $newQuotation->is_recurring = false;
                $newQuotation->quotation_status = Quotation::STATUS_DRAFT;

                unset($newQuotation->expiry_date);
                unset($newQuotation->code);
                unset($newQuotation->recurring_data);
                unset($newQuotation->next_due_date);
                
                $newQuotation->save();

                // Modificar "next due date" de la cotizacion padre sumando el ciclo de recurrencia
                // TODO: verificar el nuevo next due date, para que la cotizacion pueda cambiar a completada
                // sin necesidad de esperar al proximo next due date para que ocurra la verificacion
                $newNextDueDate = $nextDueDate->add(intval($recurringData['repeat_number']), $recurringData['repeat_every']);
                $quotation->next_due_date = $newNextDueDate;
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

    // Al pasar cotizacion recurrente a "aprobada" se debe verificar que la fecha de inicio de recurrencia sea
    // mayor o igual a la fecha actual. Si es igual a la fecha actual, generar una cotizacion hija y actualizar next due date
    // Una cotizacion recurrente en estado aprobada no puede cambiar parametros de recurrencia

}

?>