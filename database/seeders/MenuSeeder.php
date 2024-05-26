<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'Mie Goreng + Es Teh',
            'price' => 15000,
            'description' => 'Mie Goreng dengan kecap manis dan Es teh tawar',
            'image' => 'img/menu/mie.jpg',
            'merchant_id' => 1
        ]);

        Menu::create([
            'name' => 'Bakso Urat',
            'price' => 20000,
            'description' => 'Bakso dengan daging asli',
            'image' => 'img/menu/bakso.jpg',
            'merchant_id' => 1
        ]);

        Menu::create([
            'name' => 'Mie Ayam Paket Lengkap',
            'price' => 20000,
            'description' => 'Mie ayam dengan ayam lengkuas',
            'image' => 'img/menu/mie-ayam.jpeg',
            'merchant_id' => 1
        ]);

        Menu::create([
            'name' => 'Ayam Goreng Sambal Matah',
            'price' => 20000,
            'description' => 'Ayam goreng dengan sambal matah',
            'image' => 'img/menu/ayam.jpg',
            'merchant_id' => 2
        ]);

    }
}
