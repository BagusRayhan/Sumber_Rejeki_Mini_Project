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
            'wa' => '8769845987',
            'ig' => 'proreq_web',
            'email' => 'proreq@gmail.com'
        ]);
    }
}
