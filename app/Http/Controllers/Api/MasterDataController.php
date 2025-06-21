<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Event;
use App\Models\Company;
use App\Models\PaymentMethod;
use App\Models\PaymentProviderRequest;

class MasterDataController extends Controller
{
    /**
     * GET /api/events
     * Retrieve list of events with payment configurations.
     */
    public function events(): JsonResponse
    {
        $events = Event::with('eventPayments')->get();

        return response()->json([
            'status' => 'success',
            'data' => $events,
        ]);
    }

    /**
     * GET /api/payment-methods
     * Retrieve list of available payment methods.
     */
    public function paymentMethods(): JsonResponse
    {
        $methods = PaymentMethod::all();

        return response()->json([
            'status' => 'success',
            'data' => $methods,
        ]);
    }

    /**
     * GET /api/companies
     * Retrieve list of companies.
     */
    public function companies(): JsonResponse
    {
        $companies = Company::all();

        return response()->json([
            'status' => 'success',
            'data' => $companies,
        ]);
    }

    /**
     * GET /api/payment-provider-requests
     * Retrieve list of payment provider requests and their status.
     */
    public function paymentProviderRequests(): JsonResponse
    {
        $requests = PaymentProviderRequest::select('id', 'payment_method_name','website','event_id','company_id', 'status', 'created_at')->get();

        return response()->json([
            'status' => 'success',
            'data' => $requests,
        ]);
    }
}
