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
                'email' => 'caesarali@sindry',
                'password' => '$2y$10$28KlUODL.6PHtrdDZXySkeMkW3kiuGIlgjeEq9U2ZYPonSOcPB4Xe',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@sindry',
                'password' => '$2y$10$28KlUODL.6PHtrdDZXySkeMkW3kiuGIlgjeEq9U2ZYPonSOcPB4Xe',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
