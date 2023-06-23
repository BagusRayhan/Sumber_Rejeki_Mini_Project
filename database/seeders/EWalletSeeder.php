<?php

namespace Database\Seeders;

use App\Models\EWallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EWallet::create([
            'nama' => 'DANA',
            'qrcode' => 'dana.png'
        ]);
        EWallet::create([
            'nama' => 'OVO',
            'qrcode' => 'ovo.png'
        ]);
        EWallet::create([
            'nama' => 'GoPay',
            'qrcode' => 'gopay.png'
        ]);
        EWallet::create([
            'nama' => 'LinkAja',
            'qrcode' => 'linkaja.png'
        ]);
    }
}
