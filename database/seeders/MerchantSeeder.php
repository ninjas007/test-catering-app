<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchant;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create([
            'name' => 'Merchant 1',
            'address' => 'Jl. Cempaka Putih No. 10',
            'contact' => '081234567890',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'owner_id' => 1
        ]);
    }
}
