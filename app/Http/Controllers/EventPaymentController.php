<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Company;
use App\Models\EventPayment;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use DB;

class EventPaymentController extends Controller
{
    /**
     * Store a new event payment configuration.
     */
    public function eventPayment(Request $request)
    {
        $eventPayments = EventPayment::all();
        return view('finance.event_payment', [
            'eventPayments' => $eventPayments,
        ]);
    }

    /**
     * Update an existing event payment configuration.
     */
    public function edit($id)
    {
        $eventPayment = EventPayment::findOrFail($id);
      
        $paymentMethods = PaymentMethod::all();
        $companies = Company::all();
        return view('finance.edit_event_payment', [
            'eventPayment' => $eventPayment,
            'paymentMethods' => $paymentMethods,
            'companies' => $companies
        ]);
    }

    /**
     * Update an existing event payment configuration.
     */
    public function update(UpdatePaymentRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $eventPayment = EventPayment::findOrFail($id);

            EventPayment::updateOrCreate(
                [
                    'id' => $eventPayment->id,
                    'event_id' => $eventPayment->event_id,
                    'payment_method_id' => $eventPayment->payment_method_id,
                ],
                [
                    'company_id' => $request->company_id,
                    'vat_rate' => $request->vat_rate,
                ]
            );
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Payment configuration updated.',
                'redirect' => route('finance.event-payments')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Issue coming while updating event payment: ' . $e->getMessage(),
            ], 422);
        }
        
    }
}

