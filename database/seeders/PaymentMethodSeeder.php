<?php

namespace Database\Seeders;

use App\Helpers\ConstantHelper;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            ['name' => 'Stripe',    'type' => ConstantHelper::TYPE_TRADITIONAL, 'website' => 'https://stripe.com'],
            ['name' => 'Pay.com',   'type' => ConstantHelper::TYPE_TRADITIONAL, 'website' => 'https://pay.com'],
            ['name' => 'Apcopay',   'type' => ConstantHelper::TYPE_TRADITIONAL, 'website' => 'https://apcopay.com'],
            ['name' => 'HiPay',     'type' => ConstantHelper::TYPE_TRADITIONAL, 'website' => 'https://hipay.com'],
            ['name' => 'BPPay',     'type' => ConstantHelper::TYPE_TRADITIONAL, 'website' => 'https://bppay.com'],
            ['name' => 'Crypto Pay','type' => ConstantHelper::TYPE_CRYPTO,      'website' => 'https://cryptopay.com'],
        ];

        foreach ($methods as $data) {
            PaymentMethod::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
