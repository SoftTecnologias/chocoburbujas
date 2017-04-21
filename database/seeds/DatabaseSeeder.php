<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(TypeUnitSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(UserSeeder::class);
    }
}
