<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentProviderRequestStatusRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\PaymentProviderRequest;
use Illuminate\Http\Request;
use DB;

class PaymentProviderRequestController extends Controller
{
    /**
     * List of request a new payment provider.
     */
    public function requestPaymentProvider()
    {
        $events = Event::all();
        $companies = Company::all();
        $paymentProviders = PaymentProviderRequest::all();
        return view('finance.request_payment_provider_list', compact('events', 'companies','paymentProviders'));
    }

    /**
     * Show form to request a new payment provider.
     */
    public function createRequestPaymentProvider()
    {
        $events = Event::all();
        $companies = Company::all();

        return view('finance.request_payment_provider', compact('events', 'companies'));
    }

    /**
     * Store new payment provider request.
     */
    public function storePaymentProviderRequest(StorePaymentMethodRequest $request)
    {
        try {
            DB::beginTransaction();
            PaymentProviderRequest::create([
                'payment_method_name' => $request->payment_method_name,
                'website' => $request->website,
                'event_id' => $request->event_id,
                'company_id' => $request->company_id,
                'status' => 'pending',
            ]);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Payment provider request submitted.',
                'redirect' => route('finance.dashboard')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Issue coming while creating payment provider request: ' . $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Approve or reject a payment provider request.
     */
    public function updateStatus(UpdatePaymentProviderRequestStatusRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $providerRequest = PaymentProviderRequest::findOrFail($id);
            $providerRequest->status = $request->status;
            $providerRequest->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Request status updated.',
                'data' => $providerRequest,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Issue coming while update status of payment provider: ' . $e->getMessage(),
            ], 422);
        }
    }
}

