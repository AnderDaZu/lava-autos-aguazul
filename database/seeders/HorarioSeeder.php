<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Horario;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'start_hour' => '07:00',
            'end_hour' => '19:00'
        ]);

        Horario::create([
            'start_hour' => '19:00',
            'end_hour' => '07:00'
        ]);
    }
}
