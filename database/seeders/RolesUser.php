<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('role_users')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);
    }
}
