<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            "email" => "admin@test.com",
            "password" => '$2y$10$K60meps41IDjPEiJTyjX6uAREUSUW0V/tKMdMkc.4Mk61EMuSy8tK'
        ]);

        DB::table('users')->insert([
            'name' => 'Kasir',
            "email" => "kasir@test.com",
            "password" => '$2y$10$toGPLjoH6ZqHl5P9kHP4Y.iIBpLPH9T6yAfFN01b1uTT9sdPU1c3G'
        ]);
    }
}
