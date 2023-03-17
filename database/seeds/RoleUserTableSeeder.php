<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 'K00001',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
