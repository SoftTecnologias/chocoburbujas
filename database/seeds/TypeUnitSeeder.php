<?php

use Illuminate\Database\Seeder;

class TypeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $type=[
          [
          "descripcion" => 'PIEZA'
          ],
      ];

        DB::table('tipo_unidades')->insert($type);
    }
}
