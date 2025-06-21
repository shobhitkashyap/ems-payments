<?php

namespace App\Helpers;

class ConstantHelper
{
    // Event Locations
    public const EVENT_LOCATIONS = [
        'Malta',
        'Brazil',
        'Africa',
        'Asia',
        'East Europe',
        'Eurasia',
    ];

    // Payment Method Names
    public const PAYMENT_METHOD_NAMES = [
        'Stripe',
        'Pay.com',
        'Apcopay',
        'HiPay',
        'BPPay',
        'Crypto Pay',
    ];

    // Payment Method Types
    public const TYPE_TRADITIONAL = 'traditional';
    public const TYPE_CRYPTO = 'crypto';
    public const PAYMENT_METHOD_TYPES = [
        self::TYPE_TRADITIONAL,
        self::TYPE_CRYPTO,
    ];

    // Company Names
    public const COMPANY_NAMES = [
        'Company Malta',
        'Company Cyprus',
        'Company Brazil',
        'Company Dubai',
    ];
}
