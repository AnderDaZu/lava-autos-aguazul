<?php

namespace Database\Seeders;

use App\Models\Admin\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name' => 'Amarillo'
        ]);

        Color::create([
            'name' => 'Azul'
        ]);

        Color::create([
            'name' => 'Celeste'
        ]);

        Color::create([
            'name' => 'Beige'
        ]);

        Color::create([
            'name' => 'Blanco'
        ]);

        Color::create([
            'name' => 'Dorado'
        ]);

        Color::create([
            'name' => 'Gris'
        ]);

        Color::create([
            'name' => 'Lila'
        ]);

        Color::create([
            'name' => 'Marrón'
        ]);

        Color::create([
            'name' => 'Naranja'
        ]);

        Color::create([
            'name' => 'Negro'
        ]);

        Color::create([
            'name' => 'Plateado'
        ]);

        Color::create([
            'name' => 'Purpura'
        ]);

        Color::create([
            'name' => 'Rojo'
        ]);

        Color::create([
            'name' => 'Rosado'
        ]);

        Color::create([
            'name' => 'Turquesa'
        ]);

        Color::create([
            'name' => 'Verde'
        ]);
    }
}
