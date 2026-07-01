<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there is an admin user to author the articles
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            $admin = User::factory()->create([
                'name' => 'Admin ThriftIn',
                'email' => 'admin@thriftin.com',
                'is_admin' => true,
            ]);
        }

        $articles = [
            [
                'title' => 'Panduan Lengkap Memulai Thrifting untuk Pemula',
                'content' => '<p>Thrifting atau berbelanja pakaian bekas berkualitas kini bukan hanya sekadar tren, tetapi sudah menjadi gaya hidup, terutama bagi anak muda yang peduli terhadap lingkungan dan ingin tampil gaya tanpa harus mengeluarkan banyak uang. Bagi kamu yang baru ingin mencoba, thrifting mungkin terasa membingungkan pada awalnya karena banyaknya pilihan dan kondisi barang yang beragam.</p><p>Pertama, selalu buat daftar barang yang benar-benar kamu butuhkan. Ini akan mencegah kamu membeli barang impulsif hanya karena harganya murah. Kedua, perhatikan detail bahan dan jahitan. Pakaian vintage seringkali memiliki kualitas jahitan yang jauh lebih baik dibandingkan pakaian fast fashion saat ini. Ketiga, jangan ragu untuk berkreasi (mix and match) karena thrifting adalah tentang menemukan gaya unikmu sendiri.</p><p>Terakhir, pastikan kamu selalu mencuci pakaian hasil thrifting dengan bersih menggunakan air hangat dan deterjen antibakteri sebelum memakainya.</p>',
                'excerpt' => 'Panduan lengkap bagi pemula yang ingin mencoba thrifting. Temukan tips mencari barang berkualitas, trik tawar menawar, hingga cara mencuci pakaian bekas.',
                'image' => 'articles/article-1.png',
            ],
            [
                'title' => 'Mengapa Gaya Oversized Vintage Kembali Tren?',
                'content' => '<p>Fashion selalu berputar, dan kini kita melihat kembalinya gaya Y2K dan era 90-an yang ditandai dengan siluet pakaian oversized (kebesaran). Mulai dari blazer kebesaran, celana kargo longgar, hingga kaos grafis vintage, semuanya kembali mendominasi gaya jalanan (street style).</p><p>Daya tarik utama dari gaya oversized adalah kenyamanan maksimal yang ditawarkannya tanpa mengorbankan nilai estetika. Padu padan blazer vintage pria yang kebesaran dengan celana jeans lurus (straight cut) dan sneakers klasik bisa memberikan tampilan yang sangat chic namun tetap effortless (santai).</p><p>Thrift shop menjadi surga bagi pecinta gaya ini karena pakaian dari era 80-an dan 90-an secara alami memiliki potongan yang lebih longgar dan struktur yang lebih kaku, memberikan siluet oversized yang sempurna yang sulit ditemukan pada pakaian modern.</p>',
                'excerpt' => 'Gaya pakaian oversized atau kebesaran ala era 90-an kembali mendominasi dunia fashion. Cari tahu mengapa gaya ini sangat diminati dan cara memadukannya.',
                'image' => 'articles/article-2.png',
            ],
            [
                'title' => 'Fashion Berkelanjutan: Alasan Kamu Harus Mulai Thrifting',
                'content' => '<p>Industri fast fashion telah lama dikenal sebagai salah satu penyumbang limbah dan polusi terbesar di dunia. Jutaan ton pakaian berujung di tempat pembuangan sampah setiap tahunnya karena kualitas yang rendah dan tren yang cepat berganti. Di sinilah pentingnya peran thrifting sebagai solusi fashion yang berkelanjutan (sustainable fashion).</p><p>Dengan berbelanja pakaian bekas, kita secara langsung memperpanjang siklus hidup suatu produk dan mengurangi permintaan akan produksi pakaian baru. Ini berarti kita membantu menghemat ribuan liter air yang biasanya digunakan untuk menanam kapas, serta mengurangi emisi karbon dari proses manufaktur.</p><p>Selain ramah lingkungan, thrifting juga mendukung ekonomi sirkular dan seringkali memberdayakan usaha mikro dan kecil secara lokal. Jadi, tampil gaya tidak harus merusak bumi kita!</p>',
                'excerpt' => 'Selain hemat, thrifting adalah langkah nyata untuk mendukung fashion berkelanjutan. Pelajari dampak positif thrifting terhadap lingkungan kita.',
                'image' => 'articles/article-3.png',
            ],
            [
                'title' => 'Cara Membedakan Barang Branded Asli dan Palsu Saat Thrifting',
                'content' => '<p>Menemukan barang branded (bermerek) di tumpukan pakaian bekas bagaikan menemukan harta karun. Namun, seiring dengan popularitas barang vintage, banyak juga beredar barang replika atau palsu. Bagaimana cara memastikannya?</p><p>Langkah pertama yang paling penting adalah memeriksa tag atau label pakaian. Barang branded asli biasanya memiliki label yang dijahit dengan rapi dan menggunakan material yang berkualitas. Perhatikan font logo, letak tulisan, dan informasi negara pembuat. Banyak komunitas vintage yang menyediakan database label dari berbagai era untuk membandingkannya.</p><p>Selanjutnya, perhatikan kualitas material dan resleting. Merek ternama seperti Levi\'s atau YKK untuk resleting, serta bahan yang terasa kokoh dan berat seringkali menjadi indikator keaslian. Jika harganya terasa "terlalu bagus untuk menjadi kenyataan", ada baiknya kamu memeriksanya dua kali lipat.</p>',
                'excerpt' => 'Menemukan barang bermerek di thrift shop memang menyenangkan. Berikut adalah tips jitu untuk membedakan pakaian branded asli dari yang palsu.',
                'image' => 'articles/article-4.png',
            ],
            [
                'title' => 'Tampil Stylish dengan Budget Terbatas',
                'content' => '<p>Siapa bilang tampil modis harus selalu menguras isi dompet? Dengan sedikit kreativitas dan kesabaran, kamu bisa membangun lemari pakaian impianmu dengan budget yang sangat terbatas melalui thrifting. Kuncinya adalah pada investasi pada barang-barang basic (dasar).</p><p>Mulailah dengan mencari kemeja polos berkualitas, celana jeans dengan potongan klasik, dan jaket luar (outerwear) berwarna netral. Barang-barang ini bisa dipadupadankan (mix and match) dengan berbagai cara untuk menciptakan puluhan gaya berbeda. Jangan terlalu tergoda oleh pakaian dengan motif mencolok yang mungkin hanya bisa dipakai sekali atau dua kali.</p><p>Selain itu, belajar sedikit keterampilan menjahit dasar. Memperbaiki kancing yang lepas atau memotong celana jeans menjadi celana pendek bisa menyulap barang bekas yang terlihat usang menjadi pakaian favorit barumu.</p>',
                'excerpt' => 'Membangun gaya personal tidak harus mahal. Temukan rahasia tampil modis dan elegan hanya dengan mengandalkan pakaian thrift murah.',
                'image' => 'articles/article-5.png',
            ],
        ];

        foreach ($articles as $index => $article) {
            Article::create([
                'author_id' => $admin->id,
                'title' => $article['title'],
                'slug' => \Illuminate\Support\Str::slug($article['title']),
                'content' => $article['content'],
                'excerpt' => $article['excerpt'],
                'image' => $article['image'],
                'status' => 'published',
                'published_at' => \Carbon\Carbon::now()->subDays($index * 2), // Stagger published dates
            ]);
        }
        
        // Optionally create 2 draft articles
        Article::factory(2)->draft()->create([
            'author_id' => $admin->id,
        ]);
    }
}
