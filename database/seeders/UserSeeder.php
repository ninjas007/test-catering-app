<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Merchant User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'merchant',
            'email_verified_at' => now(),
            'gender' => 'male',
            'phone' => '0833434333',
            'address' => 'Jln. panjang menuju langit biru',
            'is_active' => 1,
            'avatar' => 'img/avatar/avatar-1.png',
        ]);

        User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make('customer1'),
            'role' => 'customer',
            'gender' => 'male',
            'email_verified_at' => now(),
            'is_active' => 1,
            'avatar' => 'img/avatar/avatar-1.png',
        ]);

        User::create([
            'name' => 'Customer 2',
            'email' => 'customer2@gmail.com',
            'password' => Hash::make('customer2'),
            'role' => 'customer',
            'gender' => 'female',
            'email_verified_at' => now(),
            'is_active' => 1,
            'avatar' => 'img/avatar/avatar-1.png',
        ]);
    }
}
