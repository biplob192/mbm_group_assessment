<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Biplob Mia',
                'email' => 'biplob@gmail.com',
                'phone' => '01930384220',
            ],
            [
                'name' => 'Rezaul Sabir',
                'email' => 'sabir@gmail.com',
                'phone' => '01930384221',
            ],
            [
                'name' => 'Hassan Mahmud',
                'email' => 'hassan@gmail.com',
                'phone' => '01930384222',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
