<?php

namespace Database\Seeders;

use App\Models\BankingAccount;
use Illuminate\Database\Seeder;

class BankingAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
            [
                'name' => 'ফয়সাল - পলাশ',
                'balance' => 100000.00,
            ],
            [
                'name' => 'জহির - নজরুল',
                'balance' => 100000.00,
            ],
            [
                'name' => 'রায়হান - ফারহান ',
                'balance' => 100000.00,
            ],
        ];

        foreach ($families as $family) {
            // updateOrCreate avoids creating duplicate rows if you run the seeder multiple times
            BankingAccount::updateOrCreate(
                ['name' => $family['name']],
                ['balance' => $family['balance']]
            );
        }
    }
}