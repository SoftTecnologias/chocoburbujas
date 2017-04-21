<?php

use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proveedores=[
            [
                "nombre"        => 'Desconocido',
                "calle"         => 'Desconocido',
                "colonia"       => 'Desconocido',
                "numero_int"    => '0001',
                "numero_ext"    => '',
                "cp"            => '63000',
                "estado"        => 'Desconocido',
                "municipio"     => 'Desconocido',
                "telefono1"     => '111111111',
                "telefono2"     => '111111111',
                "email"         => 'desconocido@desconocido.com',
                "contacto"      => 'Desconocido'
            ]
        ];

        DB::table('proveedores')->insert($proveedores);
    }
}
