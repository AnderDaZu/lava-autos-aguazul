<?php

namespace Database\Seeders;

use App\Models\Admin\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Moto urbana'
        ]);

        Type::create([
            'name' => 'Motocross y enduro'
        ]);

        Type::create([
            'name' => 'Auto'
        ]);

        Type::create([
            'name' => 'Camioneta'
        ]);

        Type::create([
            'name' => 'Autobus'
        ]);

        Type::create([
            'name' => 'Camión'
        ]);

        Type::create([
            'name' => 'Furgon'
        ]);

        Type::create([
            'name' => 'Maquinaría agrícola'
        ]);

    }
}
