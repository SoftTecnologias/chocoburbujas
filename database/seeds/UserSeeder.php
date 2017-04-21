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
        $users = [
            [
                'nombre'     => 'Carlos',
                'ape_pat'    => 'Hernández',
                'ape_mat'    => 'Velador',
                'email'      => 'careduher11@gmail.com',
                'username'   => 'administrador',
                'password'   => Hash::make('chocoburbujas'),
                'rol'        => '1',
                'img'    => 'user.png',
            ]
        ];

        foreach ($users as $user) {
            \App\User::create($user);
        }
    }
}
