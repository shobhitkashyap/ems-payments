<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name',
        'location',
        'date',
        'description',
    ];

    /**
     * Get all payments assigned to this event.
     */
    public function eventPayments(): HasMany
    {
        return $this->hasMany(EventPayment::class);
    }

    /**
     * Shortcut to get all payment methods associated via EventPayments.
     */
    public function paymentMethods()
    {
        return $this->hasManyThrough(
            PaymentMethod::class,
            EventPayment::class,
            'event_id',           // Foreign key on EventPayment table
            'id',                 // Local key on PaymentMethod table
            'id',                 // Local key on Event table
            'payment_method_id'   // Foreign key on EventPayment table
        );
    }
    /**
     * Shortcut to get all companies linked to event via EventPayments.
     */
    public function companies()
    {
        return $this->hasManyThrough(
            Company::class,
            EventPayment::class,
            'event_id',
            'id',
            'id',
            'company_id'
        );
    }

    /**
     * Get all provider requests for this event.
     */
    public function paymentProviderRequests(): HasMany
    {
        return $this->hasMany(PaymentProviderRequest::class);
    }
}
