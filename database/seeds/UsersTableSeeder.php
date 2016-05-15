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
            'password' => bcrypt('w10'),
            'last_name'	=>	'Etchart'
        ]);
    }
}
