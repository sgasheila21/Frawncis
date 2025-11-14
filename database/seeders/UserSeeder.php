<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'Sheila Member',
            'email' => 'sheila.angelina@binus.ac.id',
            'password' => '$2y$10$UqFMNCatt0shi1UGZMBSvOnOrWdIOuAxeSYBcT6SAYVkk.8BZ9T52', //123123123
            'role_id' => 1,
            'profile_picture' => 'default_user_image.png'
        ]);

        DB::table('users')->insert([
            'fullname' => 'Sheila Admin',
            'email' => 'sheila.angelina@binus.edu',
            'password' => '$2y$10$UqFMNCatt0shi1UGZMBSvOnOrWdIOuAxeSYBcT6SAYVkk.8BZ9T52', //123123123
            'role_id' => 2,
            'profile_picture' => 'default_user_image.png'
        ]);
    }
}
