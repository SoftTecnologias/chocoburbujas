<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client =[
            [
                'nombre'    => 'Carlos Eduardo',
                'ape_pat'   => 'Hernández',
                'ape_mat'   => 'Velador',
                'calle'     => 'Encino',
                'colonia'   => 'Valle de la cruz',
                'numero_int'=> '',
                'numero_ext'=> '1085',
                'cp'        => '63035',
                'estado'    => 'Nayarit',
                'municipio' => 'Tepic',
                'telefono1' => '3111566022',
                'telefono2' => '3111956909',
                'username'  => 'CarlosHernandez',
                'img'       => 'user.png',
                'email'     => 'careduher11@gmail.com',
                'password'  => Hash::make('franc0t1radores'),
                'suscrito'  => true
            ],
            [
                'nombre'    => 'Teamo',
                'ape_pat'   => 'Alvarez',
                'ape_mat'   => 'Carrera',
                'calle'     => 'Arcos de Babilonia',
                'colonia'   => 'Fraccionamiento los arcos',
                'numero_int'=> '41',
                'numero_ext'=> '',
                'cp'        => '63035',
                'estado'    => 'Nayarit',
                'municipio' => 'Tepic',
                'telefono1' => '3112631010',
                'telefono2' => '',
                'username'  => 'Talvarez',
                'img'       => 'user.png',
                'email'     => 'talvarez3@hotmail.com',
                'password'  => Hash::make('Deltax333'),
                'suscrito'  => false
            ]
        ];

        foreach ($client as $cliente) {
            \App\Cliente::create($cliente);
        }
    }
}
