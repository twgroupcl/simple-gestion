<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    public function details(Request $request, Company $company, Quotation $quotation)
    {
        return view('quotation.recurring.details', compact('company', 'quotation'));
    }

    public function endRecurring(Request $request, Company $company, Quotation $quotation)
    {
        $quotation->quotation_status = Quotation::STATUS_CANCELED;

        $quotation->updateWithoutEvents();

        return view('quotation.recurring.terminate-post', compact('company', 'quotation'));
    }
}
