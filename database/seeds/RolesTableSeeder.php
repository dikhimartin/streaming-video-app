<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'description' => 'Super Admin',
                'display_name' => 'Super Admin',
                'status' => 'Y',
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
        ]);
    }
}