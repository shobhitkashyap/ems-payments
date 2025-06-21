<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Event;
use App\Models\Company;
use App\Models\PaymentMethod;
use App\Models\EventPayment;
use Illuminate\Http\Request;
use DB;

class FinanceController extends Controller
{
    /**
     * Show list of events and payment management options.
     */
    public function index()
    {
        $events = Event::with('eventPayments.paymentMethod', 'eventPayments.company')->get();
        $paymentMethods = PaymentMethod::all();
        $companies = Company::all();
        return view('finance.dashboard', compact('events', 'paymentMethods', 'companies'));
    }

    /**
     * Show form to assign payment methods to an event.
     */
    public function editPayment($eventId)
    {
        $event = Event::findOrFail($eventId);
        $companies = Company::all();
        $paymentMethods = PaymentMethod::all();

        return view('finance.edit_payment', compact('event', 'companies', 'paymentMethods'));
    }

    /**
     * Update event payment configuration.
     */
    public function updatePayment(UpdatePaymentRequest $request, $eventId)
    {
        try {
            DB::beginTransaction();

            EventPayment::updateOrCreate(
                [
                    'event_id' => $eventId,
                    'payment_method_id' => $request->payment_method_id,
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
                'redirect' => route('finance.dashboard')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed: ' . $e->getMessage(),
            ], 422);
        }
    }
}
