<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkiResortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ski_resorts')->insert([
            [
            'name' => 'シュラランド',
            'created_at' => '2021/01/01 11:11:11',
            'address' => '修羅国高鷲町1-1'
            ],
            [
                'name' => 'シュラスノーパーク',
                'created_at' => '2021/01/01 11:11:11',
                'address' => '修羅国高鷲町1-2'
            ],
            [
                'name' => 'シュラガタケスキー場',
                'created_at' => '2021/01/01 11:11:11',
                'address' => '修羅国高鷲町1-3'
            ],
            [
                'name' => 'シュラトピア',
                'created_at' => '2021/01/01 11:11:11',
                'address' => '修羅国高鷲町1-4'
            ],
            [
                'name' => 'シュラガノ高原スキー場',
                'created_at' => '2021/01/01 11:11:11',
                'address' => '修羅国高鷲町1-5'
            ],
            
        ]);
    }
}
