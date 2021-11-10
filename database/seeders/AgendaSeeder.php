<?php

namespace Database\Seeders;

use App\Models\Admin\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agenda::create([
            'name' => '2021-10-01-6',
            'start_date' => '2021-10-01',
            'end_date' => '2021-10-07',
            'horario_id' => 1,
            'employee_id' => 6,
            'admin_id' => 1
        ]);

        Agenda::create([
            'name' => '2021-10-08-6',
            'start_date' => '2021-10-08',
            'end_date' => '2021-10-15',
            'horario_id' => 1,
            'employee_id' => 6,
            'admin_id' => 1
        ]);

        Agenda::create([
            'name' => '2021-10-16-6',
            'start_date' => '2021-10-16',
            'end_date' => '2021-10-22',
            'horario_id' => 1,
            'employee_id' => 6,
            'admin_id' => 1
        ]);

        Agenda::create([
            'name' => '2021-11-06-6',
            'start_date' => '2021-10-31',
            'end_date' => '2021-11-06',
            'horario_id' => 1,
            'employee_id' => 7,
            'admin_id' => 1
        ]);

        Agenda::create([
            'name' => '2021-11-16-6',
            'start_date' => '2021-11-07',
            'end_date' => '2021-11-16',
            'horario_id' => 2,
            'employee_id' => 6,
            'admin_id' => 1
        ]);
    }
}
