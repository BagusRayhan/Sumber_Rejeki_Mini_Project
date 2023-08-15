<?php

namespace Database\Seeders;

use App\Models\Aboutproreq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aboutproreq::create([
            'about' => 'PROREQ adalah penyedia layanan untuk memudahkan Anda dalam membuat aplikasi untuk project dan kebutuhan khusus Anda. Apapun project yang Anda berikan, dari pengembangan aplikasi, desain grafis, hingga penulisan konten kami siap untuk membantu Anda membangun aplikasi yang anda inginkan.'
        ]);
    }
}
