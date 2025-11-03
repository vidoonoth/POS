<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '123-456-7890',
                'address' => '123 Main St, City',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '098-765-4321',
                'address' => '456 Oak Ave, Town',
            ],
            [
                'name' => 'Walk-in Customer',
                'email' => null,
                'phone' => null,
                'address' => null,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
