<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands=[
            ['nombre'=>'TIER',
             'img'   =>'marca.png'
            ],
            ['nombre'=>'TIBET',
                'img'   =>'marca.png'],
            ['nombre'=>'STUZZY',
                'img'   =>'marca.png'],
            ['nombre'=>'SAN JERONIMO',
                'img'   =>'marca.png'],
            ['nombre'=>'PROPLAN PURINA',
                'img'   =>'marca.png'],
            ['nombre'=>'ONLY PETS',
                'img'   =>'marca.png'],
            ['nombre'=>'NUTRIVET',
                'img'   =>'marca.png'],
            ['nombre'=>'NUPEC',
                'img'   =>'marca.png'],
            ['nombre'=>'HILLS',
                'img'   =>'marca.png'],
            ['nombre'=>'DIAMOND',
                'img'   =>'marca.png'],
            ['nombre'=>'ACUARIO ARBOLEDAS',
                'img'   =>'marca.png'],
            ['nombre'=>'URUS',
                'img'   =>'marca.png'],
            ['nombre'=>'EUKANUBA',
                'img'   =>'marca.png']
        ];


        DB::table('marcas')->insert($brands);


    }
}
