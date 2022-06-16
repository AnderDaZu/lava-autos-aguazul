<?php

namespace Database\Seeders;

use App\Models\Admin\Duration;
use Illuminate\Database\Seeder;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Duration::create([
            'duration' => 45
        ]);
        Duration::create([
            'duration' => 90
        ]);
        Duration::create([
            'duration' => 135
        ]);
        Duration::create([
            'duration' => 180
        ]);
        Duration::create([
            'duration' => 225
        ]);
        Duration::create([
            'duration' => 270
        ]);
    }
}
