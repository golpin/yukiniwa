<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => '1',
            'ski_resort_id' => '1',
            'title' => 'test',
            'content' => 'testtesttest',
            'created_at' => '2021/01/01 11:11:11',
        ]);
    }
}
