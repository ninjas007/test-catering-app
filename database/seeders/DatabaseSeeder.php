<?php

namespace Database\Seeders;

use Database\Seeders\MerchantSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MerchantSeeder::class,
            MenuSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class
        ]);
    }
}
