<?php

namespace Database\Seeders;

use App\Models\Admin\Range;
use Illuminate\Database\Seeder;

class RangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rangos de día

        Range::create([
            'start' => '07:00',
            'end' => '07:45',
        ]);

        Range::create([
            'start' => '07:45',
            'end' => '08:30',
        ]);

        Range::create([
            'start' => '08:30',
            'end' => '09:15',
        ]);

        Range::create([
            'start' => '09:15',
            'end' => '10:00',
        ]);

        Range::create([
            'start' => '10:00',
            'end' => '10:45',
        ]);

        Range::create([
            'start' => '10:45',
            'end' => '11:30',
        ]);

        Range::create([
            'start' => '11:30',
            'end' => '12:15',
        ]);

        Range::create([
            'start' => '12:15',
            'end' => '13:00',
        ]);

        Range::create([
            'start' => '13:00',
            'end' => '13:45',
        ]);

        Range::create([
            'start' => '13:45',
            'end' => '14:30',
        ]);

        Range::create([
            'start' => '14:30',
            'end' => '15:15',
        ]);

        Range::create([
            'start' => '15:15',
            'end' => '16:00',
        ]);

        Range::create([
            'start' => '16:00',
            'end' => '16:45',
        ]);

        Range::create([
            'start' => '16:45',
            'end' => '17:30',
        ]);

        Range::create([
            'start' => '17:30',
            'end' => '18:15',
        ]);

        Range::create([
            'start' => '18:15',
            'end' => '19:00',
        ]);

        // Rangos de noche

        Range::create([
            'start' => '19:00',
            'end' => '19:45',
        ]);

        Range::create([
            'start' => '19:45',
            'end' => '20:30',
        ]);

        Range::create([
            'start' => '20:30',
            'end' => '21:15',
        ]);

        Range::create([
            'start' => '21:15',
            'end' => '22:00',
        ]);

        Range::create([
            'start' => '22:00',
            'end' => '22:45',
        ]);

        Range::create([
            'start' => '22:45',
            'end' => '23:30',
        ]);

        // Range::create([
        //     'start' => '23:30',
        //     'end' => '00:15',
        // ]);

        Range::create([
            'start' => '00:15',
            'end' => '01:00',
        ]);

        Range::create([
            'start' => '01:00',
            'end' => '01:45',
        ]);

        Range::create([
            'start' => '01:45',
            'end' => '02:30',
        ]);

        Range::create([
            'start' => '02:30',
            'end' => '03:15',
        ]);

        Range::create([
            'start' => '03:15',
            'end' => '04:00',
        ]);

        Range::create([
            'start' => '04:00',
            'end' => '04:45',
        ]);

        Range::create([
            'start' => '04:45',
            'end' => '05:30',
        ]);

        Range::create([
            'start' => '05:30',
            'end' => '06:15',
        ]);

        Range::create([
            'start' => '06:15',
            'end' => '07:00',
        ]);

    }
}
