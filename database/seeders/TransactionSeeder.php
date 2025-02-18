<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'customer_id' => 1,
            'transaction_type' => 'credit',
            'amount' => 100,
            'ip' => '123.66.23.44'
        ]);
    }
}
