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
            'user_name' => 'ander96',
            'name' => 'Anderson',
            'last_name' => 'Daza',
            'birthdate' => '1996-10-20',
            'phone' => '3216549871',
            'state_id' => 1,
            'email' => 'anderson@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678') 
        ])->assignRole(['management']);

        User::create([
            'user_name' => 'kener1',
            'name' => 'Kener',
            'last_name' => 'Rodríguez',
            'birthdate' => '1999-03-10',
            'identification' => '1236549872',
            'phone' => '3216549856',
            'state_id' => 1,
            'email' => 'kener@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678')
        ])->assignRole(['admin']);

        User::create([
            'user_name' => 'karen1',
            'name' => 'Karen',
            'last_name' => 'Diaz',
            'birthdate' => '2000-11-05',
            'identification' => '1236549963',
            'phone' => '3216547845',
            'state_id' => 1,
            'email' => 'karen@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678')
        ])->assignRole(['admin']);

        User::create([
            'user_name' => 'sebas1',
            'name' => 'Sebastian',
            'last_name' => 'Garzon',
            'birthdate' => '2001-01-11',
            'identification' => '1016549963',
            'phone' => '3216541245',
            'state_id' => 1,
            'email' => 'sebas@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678')
        ])->assignRole(['yard_manager']);

        User::create([
            'user_name' => 'juan1',
            'name' => 'Juan',
            'last_name' => 'Salcedo',
            'birthdate' => '1998-05-20',
            'identification' => '1026549963',
            'phone' => '3108549871',
            'state_id' => 1,
            'email' => 'juan@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678')
        ])->assignRole(['yard_manager']);

        User::create([
            'user_name' => 'luisa1',
            'name' => 'Luisa',
            'last_name' => 'Martínez',
            'birthdate' => '2003-06-30',
            'identification' => '1006549963',
            'phone' => '3116549456',
            'state_id' => 1,
            'email' => 'luisa@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['employee']);

        User::create([
            'user_name' => 'alberto1',
            'name' => 'Alberto',
            'last_name' => 'Cardenaz',
            'birthdate' => '2001-05-15',
            'identification' => '1036649963',
            'phone' => '3016549159',
            'state_id' => 1,
            'email' => '   alberto@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['employee']);

        User::create([
            'user_name' => 'antonio1',
            'name' => 'Antonio',
            'last_name' => 'Castañeda',
            'birthdate' => '2000-06-10',
            'identification' => '1036645613',
            'phone' => '3018619159',
            'state_id' => 1,
            'email' => '   antonio@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['employee']);

        User::create([
            'user_name' => 'alfonso01',
            'name' => 'Alfonso',
            'last_name' => 'Ramirez',
            'birthdate' => '1998-11-03',
            'identification' => '1035749963',
            'phone' => '3016565459',
            'state_id' => 1,
            'email' => 'alfonso@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['employee']);

        User::create([
            'user_name' => 'andrea02',
            'name' => 'Andrea',
            'last_name' => 'Sanchez',
            'state_id' => 1,
            'email' => 'andrea02@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['user']);

        User::create([
            'user_name' => 'carlos03',
            'name' => 'Carlos',
            'last_name' => 'Morales',
            'state_id' => 1,
            'email' => 'carlos03@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['user']);

        User::create([
            'user_name' => 'mariom',
            'name' => 'Mario',
            'last_name' => 'Sabato',
            'state_id' => 1,
            'email' => 'mario@g.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ])->assignRole(['user']);

        // User::factory(29)->create();
        
    }
}
