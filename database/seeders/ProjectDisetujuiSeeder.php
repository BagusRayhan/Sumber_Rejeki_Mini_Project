<?php

namespace Database\Seeders;

use App\Models\ProjectDisetujui;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectDisetujuiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectDisetujui::create([
            'namaclient' => 'Harja',
            'namaproject' => 'Website Sekolah',
            'progressproject' => '50',
            'hargaproject' => '20.000.000',
            'dokumenpendukung' => 'sekolah.pdf',
            'deadline' => '2023-06-25 13:24:59',
            'estimasi' => '8 Hari',
        ]);
        ProjectDisetujui::create([
            'namaclient' => 'Kaja',
            'namaproject' => 'Website Online Shop',
            'progressproject' => '80',
            'hargaproject' => '40.000.000',
            'dokumenpendukung' => 'olshop.pdf',
            'deadline' => '2023-06-25 13:24:59',
            'estimasi' => '8 Hari',
        ]);
    }
}
