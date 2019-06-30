<?php

use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();
        DB::table('types')->insert([
            ['name' => 'Baju Kaos/Kemeja', 'price' => 5000],
            ['name' => 'Celana (Jeans)', 'price' => 8000],
            ['name' => 'Handuk', 'price' => 8000],
            ['name' => 'Sprei', 'price' => 12000],
            ['name' => 'Selimut', 'price' => 20000],
            ['name' => 'Boneka', 'price' => 15000]
        ]);
    }
}
