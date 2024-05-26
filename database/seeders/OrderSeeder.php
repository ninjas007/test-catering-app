<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 3,
            'status' => 'pending',
            'delivery_date' => date('Y-m-d', strtotime('+2 days')),
            'delivery_time' => date('H:i', strtotime('+2 days')),
            'total' => 55000,
        ]);

        Order::create([
            'user_id' => 4,
            'status' => 'completed',
            'delivery_date' => date('Y-m-d', strtotime('+2 days')),
            'delivery_time' => date('H:i', strtotime('+2 days')),
            'total' => 55000,
        ]);
    }
}
