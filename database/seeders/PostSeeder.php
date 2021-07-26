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
            [
                'user_id' => '1',
                'ski_resort_id' => '1',
                'title' => '今季初滑り！',
                'content' => '今年の目標滑走日数は30日！',
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'user_id' => '1',
                'ski_resort_id' => '2',
                'title' => '今季初滑り！',
                'content' => '今年の目標滑走日数は30日！',
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'user_id' => '2',
                'ski_resort_id' => '3',
                'title' => '今季初滑り！',
                'content' => '今年の目標滑走日数は30日！',
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'user_id' => '1',
                'ski_resort_id' => '5',
                'title' => 'チョッカリオン！',
                'content' => 'チョッカリオン出場しました！',
                'created_at' => '2021/01/01 11:11:11',
            ]

        ]);
    }
}
