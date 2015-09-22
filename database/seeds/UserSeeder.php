<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this will be the user for all "core" stuff
        App\User::create(array('name' => 'TheFunPimps',
            'email'=>'rongothebold@yahoo.com',
            'admin' => 0,
            'password' => bcrypt('asdlkf;j34ljal3jr aedfD#$ K#RFDSXFCvdfsdhfsdfsdfs')));
        App\User::create(array('name' => 'RongoTheBold',
            'email'=>'jhansen69@gmail.com',
            'admin' => 1,
            'password' => bcrypt('d!v3b0y')));

    }
}
