<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01725361208',
            'password' => Hash::make('password'),
        ]);
        $employee = User::create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'phone' => '01725361209',
            'password' => Hash::make('password'),
        ]);
        $storeExecutive = User::create([
            'name' => 'Store Executive',
            'email' => 'se@gmail.com',
            'phone' => '01725361210',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('Admin');
        $employee->assignRole('Employee');
        $storeExecutive->assignRole('Store_Executive');
    }
}
