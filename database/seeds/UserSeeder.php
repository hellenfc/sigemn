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
      \DB::table('subscripcions')->insert(array(
      'nombre' => 'trimestral',
      'fechaFinal' => '2016-03-01',
      'fechaInicio' => '2016-04-01'
        ));

        \DB::table('subscripcions')->insert(array(
      'nombre' => 'trimestral',
      'fechaFinal' => '2016-05-01',
      'fechaInicio' => '2016-06-01'
        ));
     //
      \DB::table('users')->insert(array(
     'userName' => 'Tutor1',
     'password' => bcrypt('123456'),
     'userType' => '2',
     'idSubscripcion' => '1'
   //
  //    'idSubscripcion' => '1'
   ));
   //
       \DB::table('users')->insert(array(
     'userName' => 'Tutor2',
     'password' => bcrypt('123456'),
     'userType' => '2',

     'idSubscripcion' => '1'
      ));

        \DB::table('users')->insert(array(
     'userName' => 'admin',
     'password' => bcrypt('123456'),
     'userType' => '0',
     'idSubscripcion' => '1'
      ));

        \DB::table('users')->insert(array(
     'userName' => 'admin2',
     'password' => bcrypt('123456'),
     'userType' => '0',
     'idSubscripcion' => '2'
      ));



    //       \DB::table('users')->insert(array(
    //  'userName' => 'maestro1',
    //  'password' => bcrypt('123456'),
    //  'userType' => '1',
     //
    //  'idSubscripcion' => '1'
    //   ));
     //
    //       \DB::table('users')->insert(array(
    //  'userName' => 'maestro2',
    //  'password' => bcrypt('123456'),
    //  'userType' => '1',
     //
    //  'idSubscripcion' => '1'
    //   ));




    }
}
