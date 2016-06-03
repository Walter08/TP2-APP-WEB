<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Meto un usuario
        User::create([
            'name'	=>	'Walter',
            'email'	=>	'wetchart@mail.com',
            'password' => bcrypt('walter10'),
            'last_name'	=>	'Etchart'
        ]);

        User::create([
            'name'  =>  'Juanito',
            'email' =>  'juan@nito.com',
            'password' => bcrypt('juanito10'),
            'last_name' =>  'Tito'
        ]);
    }
}
