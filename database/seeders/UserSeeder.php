<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Anderson',
            'last_name' => 'Daza',
            'birthdate' => '1996-10-20',
            'phone' => '3216549871',
            'email' => 'anderson@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678')
        ])->assignRole(['management']);

        User::factory(9)->create();
    }
}
