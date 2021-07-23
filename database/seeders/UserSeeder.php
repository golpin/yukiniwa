<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
            'name' => 'user1',
            'email' => 'user1@test.com',
            'password' => Hash::make('zxcv1234'),
            'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@test.com',
                'password' => Hash::make('zxcv1234'),
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => 'user3',
                'email' => 'user3@test.com',
                'password' => Hash::make('zxcv1234'),
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => 'user4',
                'email' => 'user4@test.com',
                'password' => Hash::make('zxcv1234'),
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'name' => 'user5',
                'email' => 'user5@test.com',
                'password' => Hash::make('zxcv1234'),
                'created_at' => '2021/01/01 11:11:11',
            ],
            
        ]);
    }
}
