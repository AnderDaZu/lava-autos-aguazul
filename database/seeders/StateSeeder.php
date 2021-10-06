<?php

namespace Database\Seeders;

use App\Models\Admin\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'name' => 'Activo'
        ]);

        State::create([
            'name' => 'Inactivo'
        ]);
    }
}
