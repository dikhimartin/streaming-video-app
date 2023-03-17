<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'roles-list',
                'display_name' => 'Role List',
                'description' => 'Role List',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 2,
                'name' => 'roles-create',
                'display_name' => 'Role Add',
                'description' => 'Role Add',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 3,
                'name' => 'roles-edit',
                'display_name' => 'Role Edit',
                'description' => 'Role Edit',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 4,
                'name' => 'roles-delete',
                'display_name' => 'Role Delete',
                'description' => 'Role Delete',
                'sort' => 2,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 5,
                'name' => 'users-list',
                'display_name' => 'Users List',
                'description' => 'Users list',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 6,
                'name' => 'users-create',
                'display_name' => 'Users Create',
                'description' => 'Users create',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 7,
                'name' => 'users-edit',
                'display_name' => 'Users Edit',
                'description' => 'Users edit',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 8,
                'name' => 'users-delete',
                'display_name' => 'Users Delete',
                'description' => 'Users delete',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 9,
                'name' => 'group_user-list',
                'display_name' => 'Group List',
                'description' => 'Group List',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 10,
                'name' => 'group_user-create',
                'display_name' => 'Group Create',
                'description' => 'Group Create',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 11,
                'name' => 'group_user-edit',
                'display_name' => 'Group Edit',
                'description' => 'Group Edit',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ],
            [
                'id' => 12,
                'name' => 'group_user-delete',
                'display_name' => 'Group Delete',
                'description' => 'Group Delete',
                'sort' => 1,
                'created_at' => '2023-03-17 14:24:23',
                'updated_at' => '2023-03-17 14:24:23'
            ]
        ]);
    }
}
