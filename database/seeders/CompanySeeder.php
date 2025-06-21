<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Company Malta',
                'bank_account' => 'MT84MALT011000012345MTLCAST001',
                'vat_rate' => 18.0,
            ],
            [
                'name' => 'Company Cyprus',
                'bank_account' => 'CY17002001280000001200527600',
                'vat_rate' => 19.0,
            ],
            [
                'name' => 'Company Brazil',
                'bank_account' => 'BR18000000000000010934250667C1',
                'vat_rate' => 17.0,
            ],
            [
                'name' => 'Company Dubai',
                'bank_account' => 'AE070331234567890123456',
                'vat_rate' => 5.0,
            ],
        ];

        foreach ($companies as $data) {
            Company::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
