<?php

namespace Database\Seeders;

use App\Models\Admin\Space;
use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Horarios Diurnos

        // 7:00 ...

        Space::create([
            'start_hour' => '7:00',
            'end_hour' => '7:45',
            'group' => 1,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:00',
            'end_hour' => '8:30',
            'group' => 1,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:00',
            'end_hour' => '9:15',
            'group' => 1,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:00',
            'end_hour' => '10:00',
            'group' => 1,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:00',
            'end_hour' => '10:45',
            'group' => 1,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:00',
            'end_hour' => '11:30',
            'group' => 1,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 7:45 ...

        Space::create([
            'start_hour' => '7:45',
            'end_hour' => '8:30',
            'group' => 2,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:45',
            'end_hour' => '9:15',
            'group' => 2,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:45',
            'end_hour' => '10:00',
            'group' => 2,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:45',
            'end_hour' => '10:45',
            'group' => 2,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:45',
            'end_hour' => '11:30',
            'group' => 2,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '7:45',
            'end_hour' => '12:15',
            'group' => 2,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 8:30 ...

        Space::create([
            'start_hour' => '8:30',
            'end_hour' => '9:15',
            'group' => 3,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '8:30',
            'end_hour' => '10:00',
            'group' => 3,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '8:30',
            'end_hour' => '10:45',
            'group' => 3,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '8:30',
            'end_hour' => '11:30',
            'group' => 3,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '8:30',
            'end_hour' => '12:15',
            'group' => 3,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '8:30',
            'end_hour' => '13:00',
            'group' => 3,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 9:15 ...

        Space::create([
            'start_hour' => '9:15',
            'end_hour' => '10:00',
            'group' => 4,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '9:15',
            'end_hour' => '10:45',
            'group' => 4,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '9:15',
            'end_hour' => '11:30',
            'group' => 4,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '9:15',
            'end_hour' => '12:15',
            'group' => 4,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '9:15',
            'end_hour' => '13:00',
            'group' => 4,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '9:15',
            'end_hour' => '13:45',
            'group' => 4,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 10:00 ...

        Space::create([
            'start_hour' => '10:00',
            'end_hour' => '10:45',
            'group' => 5,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:00',
            'end_hour' => '11:30',
            'group' => 5,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:00',
            'end_hour' => '12:15',
            'group' => 5,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:00',
            'end_hour' => '13:00',
            'group' => 5,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:00',
            'end_hour' => '13:45',
            'group' => 5,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:00',
            'end_hour' => '14:30',
            'group' => 5,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 10:45 ...

        Space::create([
            'start_hour' => '10:45',
            'end_hour' => '11:30',
            'group' => 6,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:45',
            'end_hour' => '12:15',
            'group' => 6,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:45',
            'end_hour' => '13:00',
            'group' => 6,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:45',
            'end_hour' => '13:45',
            'group' => 6,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:45',
            'end_hour' => '14:30',
            'group' => 6,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '10:45',
            'end_hour' => '15:15',
            'group' => 6,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 11:30 ...

        Space::create([
            'start_hour' => '11:30',
            'end_hour' => '12:15',
            'group' => 7,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '11:30',
            'end_hour' => '13:00',
            'group' => 7,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '11:30',
            'end_hour' => '13:45',
            'group' => 7,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '11:30',
            'end_hour' => '14:30',
            'group' => 7,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '11:30',
            'end_hour' => '15:15',
            'group' => 7,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '11:30',
            'end_hour' => '16:00',
            'group' => 7,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 12:15

        Space::create([
            'start_hour' => '12:15',
            'end_hour' => '13:00',
            'group' => 8,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '12:15',
            'end_hour' => '13:45',
            'group' => 8,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '12:15',
            'end_hour' => '14:30',
            'group' => 8,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '12:15',
            'end_hour' => '15:15',
            'group' => 8,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '12:15',
            'end_hour' => '16:00',
            'group' => 8,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '12:15',
            'end_hour' => '16:45',
            'group' => 8,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 13:00 ...

        Space::create([
            'start_hour' => '13:00',
            'end_hour' => '13:45',
            'group' => 9,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:00',
            'end_hour' => '14:30',
            'group' => 9,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:00',
            'end_hour' => '15:15',
            'group' => 9,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:00',
            'end_hour' => '16:00',
            'group' => 9,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:00',
            'end_hour' => '16:45',
            'group' => 9,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:00',
            'end_hour' => '17:30',
            'group' => 9,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 13:45 ...

        Space::create([
            'start_hour' => '13:45',
            'end_hour' => '14:30',
            'group' => 10,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:45',
            'end_hour' => '15:15',
            'group' => 10,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:45',
            'end_hour' => '16:00',
            'group' => 10,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:45',
            'end_hour' => '16:45',
            'group' => 10,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:45',
            'end_hour' => '17:30',
            'group' => 10,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '13:45',
            'end_hour' => '18:15',
            'group' => 10,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 14:30 ...

        Space::create([
            'start_hour' => '14:30',
            'end_hour' => '15:15',
            'group' => 11,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '14:30',
            'end_hour' => '16:00',
            'group' => 11,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '14:30',
            'end_hour' => '16:45',
            'group' => 11,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '14:30',
            'end_hour' => '17:30',
            'group' => 11,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '14:30',
            'end_hour' => '18:15',
            'group' => 11,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '14:30',
            'end_hour' => '19:00',
            'group' => 11,
            'horario_id' => 1,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 15:15 ...

        Space::create([
            'start_hour' => '15:15',
            'end_hour' => '16:00',
            'group' => 12,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '15:15',
            'end_hour' => '16:45',
            'group' => 12,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '15:15',
            'end_hour' => '17:30',
            'group' => 12,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '15:15',
            'end_hour' => '18:15',
            'group' => 12,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '15:15',
            'end_hour' => '19:00',
            'group' => 12,
            'horario_id' => 1,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);

        // 16:00 ...

        Space::create([
            'start_hour' => '16:00',
            'end_hour' => '16:45',
            'group' => 13,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '16:00',
            'end_hour' => '17:30',
            'group' => 13,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '16:00',
            'end_hour' => '18:15',
            'group' => 13,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '16:00',
            'end_hour' => '19:00',
            'group' => 13,
            'horario_id' => 1,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);

        // 16:45 ...

        Space::create([
            'start_hour' => '16:45',
            'end_hour' => '17:30',
            'group' => 14,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '16:45',
            'end_hour' => '18:15',
            'group' => 14,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '16:45',
            'end_hour' => '19:00',
            'group' => 14,
            'horario_id' => 1,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);

        // 17:30

        Space::create([
            'start_hour' => '17:30',
            'end_hour' => '18:15',
            'group' => 15,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '17:30',
            'end_hour' => '19:00',
            'group' => 15,
            'horario_id' => 1,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);

        // 18:15

        Space::create([
            'start_hour' => '18:15',
            'end_hour' => '19:00',
            'group' => 16,
            'horario_id' => 1,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);

        // Horarios Nocturnos

        // 19:00 ...

        Space::create([
            'start_hour' => '19:00',
            'end_hour' => '19:45',
            'group' => 17,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:00',
            'end_hour' => '20:30',
            'group' => 17,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:00',
            'end_hour' => '21:15',
            'group' => 17,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:00',
            'end_hour' => '22:00',
            'group' => 17,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:00',
            'end_hour' => '22:45',
            'group' => 17,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:00',
            'end_hour' => '23:30',
            'group' => 17,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 19:45 ...

        Space::create([
            'start_hour' => '19:45',
            'end_hour' => '20:30',
            'group' => 18,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:45',
            'end_hour' => '21:15',
            'group' => 18,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:45',
            'end_hour' => '22:00',
            'group' => 18,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:45',
            'end_hour' => '22:45',
            'group' => 18,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:45',
            'end_hour' => '23:30',
            'group' => 18,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '19:45',
            'end_hour' => '00:15',
            'group' => 18,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 20:30 ...

        Space::create([
            'start_hour' => '20:30',
            'end_hour' => '21:15',
            'group' => 19,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '20:30',
            'end_hour' => '22:00',
            'group' => 19,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '20:30',
            'end_hour' => '22:45',
            'group' => 19,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '20:30',
            'end_hour' => '23:30',
            'group' => 19,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '20:30',
            'end_hour' => '00:15',
            'group' => 19,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '20:30',
            'end_hour' => '01:00',
            'group' => 19,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 21:15

        Space::create([
            'start_hour' => '21:15',
            'end_hour' => '22:00',
            'group' => 20,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '21:15',
            'end_hour' => '22:45',
            'group' => 20,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '21:15',
            'end_hour' => '23:30',
            'group' => 20,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '21:15',
            'end_hour' => '00:15',
            'group' => 20,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '21:15',
            'end_hour' => '01:00',
            'group' => 20,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '21:15',
            'end_hour' => '01:45',
            'group' => 20,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 22:00 ...

        Space::create([
            'start_hour' => '22:00',
            'end_hour' => '22:45',
            'group' => 21,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:00',
            'end_hour' => '23:30',
            'group' => 21,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:00',
            'end_hour' => '00:15',
            'group' => 21,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:00',
            'end_hour' => '01:00',
            'group' => 21,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:00',
            'end_hour' => '01:45',
            'group' => 21,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:00',
            'end_hour' => '02:30',
            'group' => 21,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 22:45 ...

        Space::create([
            'start_hour' => '22:45',
            'end_hour' => '23:30',
            'group' => 22,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:45',
            'end_hour' => '00:15',
            'group' => 22,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:45',
            'end_hour' => '01:00',
            'group' => 22,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:45',
            'end_hour' => '01:45',
            'group' => 22,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:45',
            'end_hour' => '02:30',
            'group' => 22,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '22:45',
            'end_hour' => '03:15',
            'group' => 22,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 23:30 ...

        Space::create([
            'start_hour' => '23:30',
            'end_hour' => '00:15',
            'group' => 23,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '23:30',
            'end_hour' => '01:00',
            'group' => 23,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '23:30',
            'end_hour' => '01:45',
            'group' => 23,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '23:30',
            'end_hour' => '02:30',
            'group' => 23,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '23:30',
            'end_hour' => '03:15',
            'group' => 23,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '23:30',
            'end_hour' => '04:00',
            'group' => 23,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 00:15 ...

        Space::create([
            'start_hour' => '00:15',
            'end_hour' => '01:00',
            'group' => 24,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '00:15',
            'end_hour' => '01:45',
            'group' => 24,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '00:15',
            'end_hour' => '02:30',
            'group' => 24,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '00:15',
            'end_hour' => '03:15',
            'group' => 24,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '00:15',
            'end_hour' => '04:00',
            'group' => 24,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '00:15',
            'end_hour' => '04:45',
            'group' => 24,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 01:00 ...

        Space::create([
            'start_hour' => '01:00',
            'end_hour' => '01:45',
            'group' => 25,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:00',
            'end_hour' => '02:30',
            'group' => 25,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:00',
            'end_hour' => '03:15',
            'group' => 25,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:00',
            'end_hour' => '04:00',
            'group' => 25,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:00',
            'end_hour' => '04:45',
            'group' => 25,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:00',
            'end_hour' => '05:30',
            'group' => 25,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 01:45 ...

        Space::create([
            'start_hour' => '01:45',
            'end_hour' => '02:30',
            'group' => 26,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:45',
            'end_hour' => '03:15',
            'group' => 26,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:45',
            'end_hour' => '04:00',
            'group' => 26,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:45',
            'end_hour' => '04:45',
            'group' => 26,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:45',
            'end_hour' => '05:30',
            'group' => 26,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '01:45',
            'end_hour' => '06:15',
            'group' => 26,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 02:30 ...

        Space::create([
            'start_hour' => '02:30',
            'end_hour' => '03:15',
            'group' => 27,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '02:30',
            'end_hour' => '04:00',
            'group' => 27,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '02:30',
            'end_hour' => '04:45',
            'group' => 27,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '02:30',
            'end_hour' => '05:30',
            'group' => 27,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '02:30',
            'end_hour' => '06:15',
            'group' => 27,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '02:30',
            'end_hour' => '07:00',
            'group' => 27,
            'horario_id' => 2,
            'duration_id' => 6,
            'times_taken' => 0,
        ]);

        // 03:15

        Space::create([
            'start_hour' => '03:15',
            'end_hour' => '04:00',
            'group' => 28,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '03:15',
            'end_hour' => '04:45',
            'group' => 28,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '03:15',
            'end_hour' => '05:30',
            'group' => 28,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '03:15',
            'end_hour' => '06:15',
            'group' => 28,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '03:15',
            'end_hour' => '07:00',
            'group' => 28,
            'horario_id' => 2,
            'duration_id' => 5,
            'times_taken' => 0,
        ]);

        // 04:00 ...

        Space::create([
            'start_hour' => '04:00',
            'end_hour' => '04:45',
            'group' => 29,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '04:00',
            'end_hour' => '05:30',
            'group' => 29,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '04:00',
            'end_hour' => '06:15',
            'group' => 29,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '04:00',
            'end_hour' => '07:00',
            'group' => 29,
            'horario_id' => 2,
            'duration_id' => 4,
            'times_taken' => 0,
        ]);

        // 04:45 ...

        Space::create([
            'start_hour' => '04:45',
            'end_hour' => '05:30',
            'group' => 30,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '04:45',
            'end_hour' => '06:15',
            'group' => 30,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '04:45',
            'end_hour' => '07:00',
            'group' => 30,
            'horario_id' => 2,
            'duration_id' => 3,
            'times_taken' => 0,
        ]);

        // 05:30

        Space::create([
            'start_hour' => '05:30',
            'end_hour' => '06:15',
            'group' => 31,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);
        Space::create([
            'start_hour' => '05:30',
            'end_hour' => '07:00',
            'group' => 31,
            'horario_id' => 2,
            'duration_id' => 2,
            'times_taken' => 0,
        ]);

        // 06:15 ...

        Space::create([
            'start_hour' => '06:15',
            'end_hour' => '07:00',
            'group' => 32,
            'horario_id' => 2,
            'duration_id' => 1,
            'times_taken' => 0,
        ]);

    }
}
