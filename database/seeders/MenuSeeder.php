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
        ]);

        Menu::create([
            'name' => 'Bakso Urat',
            'price' => 20000,
            'description' => 'Bakso dengan daging asli',
            'image' => 'img/menu/bakso.jpg',
        ]);
    }
}
