<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'nama' => 'Bank BRI',
            'rekening' => '011101123456507'
        ]);

        Bank::create([
            'nama' => 'Bank BCA',
            'rekening' => '0001236552'
        ]);

        Bank::create([
            'nama' => 'Bank Mandiri',
            'rekening' => '1872347832176'
        ]);
    }
}
