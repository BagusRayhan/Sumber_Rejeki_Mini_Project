<?php

namespace Database\Seeders;

use App\Models\Kebijakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KebijakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kebijakan::create([
            'kebijakan' => '<p>

            <p> Efektif per 1 Juni 2023</p>

             <p>Pengenalan Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi yang Anda berikan saat menggunakan layanan kami. Kami berkomitmen untuk melindungi privasi Anda dan memperlakukan informasi pribadi dengan sebaik-baiknya. Kebijakan ini berlaku untuk semua pengguna layanan kami.</p>
             <p>Informasi yang Kami Kumpulkan Ketika Anda menggunakan layanan kami, kami dapat mengumpulkan informasi pribadi yang Anda berikan secara langsung, seperti nama, alamat email, nomor telepon, dan informasi lain yang relevan. Kami juga dapat mengumpulkan informasi non-pribadi, seperti alamat IP, jenis perangkat yang Anda gunakan, dan data statistik lainnya yang berkaitan dengan penggunaan layanan kami.</p>
            <p> Penggunaan Informasi Kami menggunakan informasi yang kami kumpulkan untuk:</p>
             <p>1.Memberikan layanan yang Anda minta dan meningkatkan pengalaman pengguna.</p>
             <p>2.Mengelola akun pengguna Anda dan memberikan dukungan pelanggan.</p>
             <p>3.Mengirimkan pembaruan, pengumuman, dan informasi lain yang relevan mengenai layanan kami.</p>
             <p>4.Menganalisis data untuk tujuan riset dan pengembangan produk.</p>
             <p>5.Melakukan tindakan yang diperlukan untuk mematuhi hukum yang berlaku.</p>

             <p>Pemrosesan dan Penyimpanan Data Kami mengadopsi langkah-langkah keamanan yang wajar untuk melindungi informasi pribadi Anda dari akses yang tidak sah, perubahan, pengungkapan, atau penghancuran yang tidak sah. Kami hanya menyimpan informasi pribadi Anda selama diperlukan untuk tujuan yang dijelaskan dalam kebijakan ini, kecuali jika hukum mengharuskan penyimpanan yang lebih lama.</p>
            <p> Pengungkapan kepada Pihak Ketiga Kami tidak akan mengungkapkan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali jika diwajibkan oleh hukum atau jika diperlukan untuk memberikan layanan yang Anda minta (misalnya, untuk pemrosesan pembayaran atau pengiriman barang).
             Kebijakan Privasi Situs Web Eksternal Layanan kami dapat mencakup tautan ke situs web eksternal yang tidak dioperasikan oleh kami. Kami tidak bertanggung jawab atas praktik privasi situs web eksternal tersebut dan kami mendorong Anda untuk membaca kebijakan privasi mereka sebelum memberikan informasi pribadi.</p>
             </p>'
        ]);
    }
}
