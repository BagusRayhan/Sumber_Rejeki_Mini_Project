<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FAQ::create([
            'question' => 'Apa layanan yang ditawarkan oleh perusahaan kami?',
            'answer' => 'Kami menyediakan layanan lengkap dalam pembuatan aplikasi dan pengembangan situs web. Kami memiliki tim ahli yang dapat merancang, mengembangkan, dan membangun aplikasi kustom sesuai dengan kebutuhan bisnis Anda. Kami juga menyediakan pengembangan situs web responsif, desain grafis, optimasi SEO, serta integrasi dan dukungan penuh untuk kehadiran digital Anda.'
        ]);
        FAQ::create([
            'question' => 'Bagaimana proses kerja dalam pembuatan aplikasi dan situs web?',
            'answer' => 'Proses kerja kami dimulai dengan mendengarkan kebutuhan dan visi Anda. Kami melakukan analisis menyeluruh untuk memahami tujuan bisnis Anda dan audiens target. Selanjutnya, kami merancang konsep dan tampilan yang sesuai dengan merek Anda. Setelah Anda menyetujui desain, kami mulai mengembangkan aplikasi atau situs web secara menyeluruh. Anda akan terlibat dalam setiap tahap pengembangan dan kami akan terus berkomunikasi dengan Anda selama seluruh proses.'
        ]);
        FAQ::create([
            'question' => 'Berapa lama waktu yang dibutuhkan untuk menyelesaikan proyek?',
            'answer' => 'Waktu yang dibutuhkan untuk menyelesaikan proyek akan bervariasi tergantung pada kompleksitas dan skala proyek. Kami berusaha untuk menyelesaikan proyek sesuai dengan tenggat waktu yang disepakati bersama Anda. Kualitas dan kepuasan klien adalah prioritas kami, jadi kami memastikan untuk memberikan hasil terbaik tanpa mengorbankan waktu yang ditetapkan.'
        ]);
    }
}
