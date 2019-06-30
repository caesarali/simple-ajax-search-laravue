<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->delete();

        $faker = Factory::create();

        for ($i=0; $i < 5; $i++) {
            DB::table('customers')->insert([
                'name' => $faker->name,
                'phone' => '081xxxxxxxxx',
                'address' => 'Jl. Rappocini Raya, Makassar.',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
