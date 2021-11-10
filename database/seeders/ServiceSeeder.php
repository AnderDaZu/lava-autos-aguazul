<?php

namespace Database\Seeders;

use App\Models\Admin\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Motos
        Service::create([
            'name' => 'Lavado',
            'price' => 6000,
            'duration' => '45',
            'type_id' => 1,
        ]);

        Service::create([
            'name' => 'Lavado y polichado',
            'price' => 8000,
            'duration' => '60',
            'type_id' => 1,
        ]);

        Service::create([
            'name' => 'Lavado',
            'price' => 10000,
            'duration' => '60',
            'type_id' => 2,
        ]);

        Service::create([
            'name' => 'Lavado y polichado',
            'price' => 12000,
            'duration' => '75',
            'type_id' => 2,
        ]);

        // Autos
        Service::create([
            'name' => 'Enjuague',
            'price' => 8000,
            'duration' => '45',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Lavado integral',
            'price' => 14000,
            'duration' => '105',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Lavado integral y polichado',
            'price' => 27000,
            'duration' => '135',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Lavado general',
            'price' => 23000,
            'duration' => '135',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Lavado general y polichado',
            'price' => 35000,
            'duration' => '165',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Lavado de cojinería',
            'price' => 35000,
            'duration' => '195',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Desmanchado de cojinería',
            'price' => 45000,
            'duration' => '255',
            'type_id' => 3,
        ]);

        Service::create([
            'name' => 'Americano (polichado a máquina)',
            'price' => 50000,
            'duration' => '135',
            'type_id' => 3,
        ]);

        // Camionetas
        Service::create([
            'name' => 'Enjuague',
            'price' => 12000,
            'duration' => '55',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Lavado integral',
            'price' => 16000,
            'duration' => '105',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Lavado integral y polichado',
            'price' => 30000,
            'duration' => '135',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Lavado general',
            'price' => 28000,
            'duration' => '135',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Lavado general y polichado',
            'price' => 40000,
            'duration' => '165',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Lavado de cojinería',
            'price' => 40000,
            'duration' => '195',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Desmanchado de cojinería',
            'price' => 50000,
            'duration' => '255',
            'type_id' => 4,
        ]);

        Service::create([
            'name' => 'Americano (polichado a máquina)',
            'price' => 60000,
            'duration' => '135',
            'type_id' => 4,
        ]);

        // Autobus
        Service::create([
            'name' => 'Lavado integral',
            'price' => 60000,
            'duration' => '165',
            'type_id' => 5,
        ]);

        Service::create([
            'name' => 'Lavado general',
            'price' => 75000,
            'duration' => '225',
            'type_id' => 5,
        ]);

        // Camión
        Service::create([
            'name' => 'Lavado integral',
            'price' => 70000,
            'duration' => '195',
            'type_id' => 6,
        ]);

        // Furgon
        Service::create([
            'name' => 'Lavado integral',
            'price' => 60000,
            'duration' => '195',
            'type_id' => 7,
        ]);

        Service::create([
            'name' => 'Lavado general',
            'price' => 75000,
            'duration' => '225',
            'type_id' => 7,
        ]);

        // Máquinaria agrícola
        Service::create([
            'name' => 'Lavado general',
            'price' => 75000,
            'duration' => '195',
            'type_id' => 8,
        ]);


    }
}
