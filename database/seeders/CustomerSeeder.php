<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
            'status' => 'active'
        ]);
    }
}
