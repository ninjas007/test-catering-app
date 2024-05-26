<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::create([
            'menu_id' => 1,
            'quantity' => 1,
            'order_id' => 1,
            'subtotal' => 15000
        ]);

        OrderDetail::create([
            'menu_id' => 2,
            'quantity' => 2,
            'order_id' => 1,
            'subtotal' => 40000
        ]);

        OrderDetail::create([
            'menu_id' => 1,
            'quantity' => 1,
            'order_id' => 2,
            'subtotal' => 15000
        ]);
    }
}
