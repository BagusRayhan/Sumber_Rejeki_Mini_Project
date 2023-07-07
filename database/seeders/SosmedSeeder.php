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
            'wa' => '08388176922',
            'ig' => 'https//instagram.com/@_dikcyy',
            'email' => 'miniproreq@gmail.com'
        ]);
    }
}
