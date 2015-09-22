<?php

use Illuminate\Database\Seeder;

class ModSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Mods::create(array('name' => 'CoreGame',
            'description'=>'These are all the core game files',
            'alpha' => 12.4,
            'user_id' => 1));
    }
}
