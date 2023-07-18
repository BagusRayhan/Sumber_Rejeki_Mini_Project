<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SosmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sosmed')->insert([
            'wa' => '085745140746',
            'ig' => 'miniproreq_',
            'email' => 'miniproreq@gmail.com'
        ]);
    }
}
