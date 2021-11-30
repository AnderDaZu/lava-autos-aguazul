<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(RoleSeeder::class);

        $this->call(HorarioSeeder::class);

        $this->call(RangeSeeder::class);

        $this->call(StateSeeder::class);
        
        $this->call(UserSeeder::class);

        $this->call(MarkSeeder::class);

        $this->call(TypeSeeder::class);

        $this->call(AgendaSeeder::class);

        $this->call(ColorSeeder::class);

        $this->call(ModelcarSeeder::class);

        $this->call(VehicleSeeder::class);

        $this->call(ServiceSeeder::class);

        $this->call(AppointmentSeeder::class);

    }
}
