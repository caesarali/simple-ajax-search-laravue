<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'name' => 'Caesar Ali L.',
                'email' => 'caesaralilamondo@gmail.com',
                'password' => bcrypt('caesarali'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Desi Iriani Tamrin.',
                'email' => 'desta@gmail.com',
                'password' => bcrypt('desta'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
