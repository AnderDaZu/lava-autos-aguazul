<?php

namespace Database\Seeders;

use App\Models\Admin\Mark;
use Illuminate\Database\Seeder;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mark::create([
            'name' => 'Renault'
        ]);

        Mark::create([
            'name' => 'Chevrolet'
        ]);

        Mark::create([
            'name' => 'Mazda'
        ]);

        Mark::create([
            'name' => 'Nissan'
        ]);

        Mark::create([
            'name' => 'Kia'
        ]);

        Mark::create([
            'name' => 'Toyota'
        ]);

        Mark::create([
            'name' => 'Audi'
        ]);

        Mark::create([
            'name' => 'Volkswagen'
        ]);

        Mark::create([
            'name' => 'Suzuki'
        ]);

        Mark::create([
            'name' => 'Jeep'
        ]);

        Mark::create([
            'name' => 'Honda'
        ]);

        Mark::create([
            'name' => 'Ferrari'
        ]);

        Mark::create([
            'name' => 'BMW'
        ]);

    }
}
