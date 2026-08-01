<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $perawatan = ArticleCategory::where('slug', 'perawatan')->first();
        $proses = ArticleCategory::where('slug', 'proses')->first();
        $gaya = ArticleCategory::where('slug', 'gaya')->first();

        $articles = [
            [
                'article_category_id' => $perawatan?->id,
                'title' => 'Cara Merawat Sarung Tenun Agar Awet Bertahun-tahun',
                'slug' => 'cara-merawat-sarung-tenun-agar-awet',
                'cover_image' => null,
                'status' => 'published',
                'content' => <<<'HTML'
<p>Sarung tenun bukan sekadar kain — ada proses panjang di baliknya, dari pemilihan benang sampai tangan pengrajin yang menenunnya helai demi helai. Supaya semua proses itu gak sia-sia, cara merawatnya juga perlu diperhatikan. Berikut beberapa kebiasaan sederhana yang bisa bikin sarung tenun kamu tetap tajam warnanya dan rapi motifnya, bahkan setelah dipakai bertahun-tahun.</p>

<h2>1. Cuci dengan tangan, bukan mesin cuci</h2>
<p>Serat tenun cenderung lebih halus dibanding kain tekstil biasa. Putaran mesin cuci yang keras bisa membuat benang longgar dan motif perlahan pudar. Cuci dengan tangan menggunakan air dingin, dan hindari meremas terlalu kuat — cukup kucek perlahan di bagian yang kotor saja.</p>

<h2>2. Gunakan sabun yang lembut</h2>
<p>Deterjen dengan kandungan pemutih atau bahan kimia keras bisa merusak warna alami benang. Pilih sabun khusus kain halus, atau shampo bayi sebagai alternatif — keduanya cukup lembut untuk menjaga serat tetap utuh.</p>

<h2>3. Jangan diperas, cukup diangin-anginkan</h2>
<p>Memeras kain tenun dengan kuat bisa merusak struktur tenunannya. Setelah dicuci, cukup gantung sarung di tempat teduh dengan sirkulasi udara yang baik. Hindari menjemur langsung di bawah sinar matahari terlalu lama karena bisa membuat warna cepat pudar.</p>

<h2>4. Simpan dengan cara dilipat, bukan digantung terus-menerus</h2>
<p>Menggantung sarung dalam waktu lama bisa membuat kain melar di bagian tertentu. Lipat rapi dan simpan di tempat kering, sesekali diangin-anginkan agar tidak lembap dan berjamur.</p>

<p>Dengan perawatan yang tepat, sarung tenun bisa jadi barang yang diwariskan — bukan cuma dipakai sesaat lalu disimpan begitu saja.</p>
HTML,
            ],
            [
                'article_category_id' => $proses?->id,
                'title' => 'Mengenal ATBM, Warisan Tenun dari Pekalongan',
                'slug' => 'mengenal-atbm-warisan-tenun-pekalongan',
                'cover_image' => null,
                'status' => 'published',
                'content' => <<<'HTML'
<p>Di tengah gempuran produksi tekstil serba mesin dan cepat, ATBM — Alat Tenun Bukan Mesin — masih bertahan sebagai cara menenun yang dijaga turun-temurun di Pekalongan. Bukan karena ketinggalan zaman, tapi karena ada kualitas yang cuma bisa dihasilkan lewat proses yang sabar.</p>

<h2>Apa itu ATBM?</h2>
<p>ATBM adalah alat tenun tradisional yang digerakkan sepenuhnya oleh tangan dan kaki pengrajin, berbeda dari mesin tenun otomatis yang bergerak sendiri dengan tenaga listrik. Setiap tarikan benang, setiap ketukan, dikendalikan langsung oleh tangan manusia — itu sebabnya hasilnya punya karakter yang sulit ditiru mesin.</p>

<h2>Kenapa masih dipertahankan?</h2>
<p>Tenun ATBM menghasilkan tekstur kain yang lebih hidup — sedikit ketidaksempurnaan di setiap helai justru jadi tanda bahwa kain itu dikerjakan dengan tangan, bukan diproduksi massal. Detail motif juga bisa dikontrol lebih presisi karena pengrajin bisa menyesuaikan tarikan benang sesuai kebutuhan pola.</p>

<h2>Proses yang butuh kesabaran</h2>
<p>Menenun satu lembar sarung dengan ATBM bisa memakan waktu berhari-hari, tergantung kerumitan motifnya. Bandingkan dengan mesin tenun modern yang bisa menghasilkan kain dalam hitungan jam — tapi di situlah nilainya. Bukan soal cepat, tapi soal ketelitian yang dijaga di setiap tahap.</p>

<p>Setiap kali memakai sarung tenun ATBM, sebenarnya kita sedang membawa hasil kerja tangan yang telaten — sebuah warisan kecil dari Pekalongan yang terus dijaga hidup.</p>
HTML,
            ],
            [
                'article_category_id' => $gaya?->id,
                'title' => 'Padu Padan Sarung untuk Berbagai Acara',
                'slug' => 'padu-padan-sarung-untuk-berbagai-acara',
                'cover_image' => null,
                'status' => 'published',
                'content' => <<<'HTML'
<p>Sarung sering dianggap cuma cocok dipakai untuk ibadah atau acara formal tertentu. Padahal, dengan padu padan yang tepat, sarung tenun bisa tampil di berbagai suasana — dari acara keluarga sampai kumpul santai bareng teman.</p>

<h2>Untuk acara formal</h2>
<p>Padukan sarung motif gelap seperti navy atau maroon dengan kemeja polos warna netral (putih, krem, atau abu muda). Tambahkan peci atau songkok senada untuk kesan yang lebih rapi. Motif yang lebih detail dan warna emas biasanya cocok jadi aksen di momen-momen penting.</p>

<h2>Untuk acara keluarga atau kumpul santai</h2>
<p>Pilih motif dengan warna yang lebih cerah dan playful, dipadukan dengan kaos atau kemeja lengan pendek yang simpel. Sarung dengan motif kotak-kotak atau garis biasanya lebih fleksibel untuk suasana kasual seperti ini.</p>

<h2>Tips memilih motif</h2>
<p>Kalau baru mulai mengoleksi sarung, motif polos atau garis-garis sederhana adalah pilihan aman karena mudah dipadukan dengan atasan apa saja. Setelah itu, baru eksplorasi motif yang lebih detail sesuai selera dan kebutuhan acara.</p>

<p>Sarung bukan sekadar pelengkap ibadah — dengan sedikit kreativitas, ia bisa jadi bagian dari gaya sehari-hari yang tetap terasa personal dan penuh makna.</p>
HTML,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(['slug' => $article['slug']], $article);
        }
    }
}
