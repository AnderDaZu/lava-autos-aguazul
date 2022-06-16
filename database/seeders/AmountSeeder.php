<?php

namespace Database\Seeders;

use App\Models\Admin\Amount;
use Illuminate\Database\Seeder;

class AmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Amount::create([
            'num' => 1,
            'active' => false,
        ]);

        Amount::create([
            'num' => 2,
            'active' => true,
        ]);
        
        Amount::create([
            'num' => 3,
            'active' => false,
        ]);
        
        Amount::create([
            'num' => 4,
            'active' => false,
        ]);

        Amount::create([
            'num' => 5,
            'active' => false,
        ]);

        Amount::create([
            'num' => 6,
            'active' => false,
        ]);

    }
}
