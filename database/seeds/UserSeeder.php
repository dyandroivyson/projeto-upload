<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'id'        => 1,
            'name'      => 'Dyandro Ivyson',
            'email'     => 'dada@dada.da',
            'password'  => Hash::make('dada@123'),
            'grupo_id'  => 1
        ];

        if (!User::find($user['id'])) {
            User::create($user);
        }
    }
}
