<?php

use Illuminate\Database\Seeder;

class usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array(
         'userName' => 'Devil',
         'password' => bcrypt('123456'),
         'userType' => '0',
         'idSubscripcion' => '2'
       ));
      //
      //     \DB::table('users')->insert(array(
      //   'userName' => 'Maria',
      //   'password' => bcrypt('123456'),
      //   'userType' => '1'
      // ));
    }
}
