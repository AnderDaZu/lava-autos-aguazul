<?php

namespace Database\Seeders;

use App\Models\Api\v1\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::create([
            'date' => '2022-04-15',
            'hour_start' => '07:45',
            'hour_end' => '10:00',
            'horario_id' => 1,
            'service_id' => 6,
            'vehicle_id' => 5,
            'employee_id' => 8,
            'client_id' => 10,
            'state_id' => 2,
        ]); 

    }
}
