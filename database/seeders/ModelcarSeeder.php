<?php

namespace Database\Seeders;

use App\Models\Admin\Modelcar;
use Illuminate\Database\Seeder;

class ModelcarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modelcar::create([
            'name' => '2',
            'mark_id' => 3,
            'type_id' => 3
        ]);

        Modelcar::create([
            'name' => '3',
            'mark_id' => 3,
            'type_id' => 3
        ]);

        Modelcar::create([
            'name' => 'Logan',
            'mark_id' => 1,
            'type_id' => 3
        ]);

        Modelcar::create([
            'name' => 'Optra',
            'mark_id' => 2,
            'type_id' => 3
        ]);

        Modelcar::create([
            'name' => 'Spark',
            'mark_id' => 2,
            'type_id' => 3
        ]);

        Modelcar::create([
            'name' => 'Aveo',
            'mark_id' => 2,
            'type_id' => 3
        ]);

        Modelcar::create([
            'name' => 'Hilux',
            'mark_id' => 6,
            'type_id' => 4
        ]);

        Modelcar::create([
            'name' => 'Land Cruiser',
            'mark_id' => 6,
            'type_id' => 4
        ]);
    }
}
