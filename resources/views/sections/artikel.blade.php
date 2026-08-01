{{--
    Section: Preview Artikel
    Belum ke-connect ke DB — nanti diambil dari Article::published()->latest()->limit(3)->get()
    Halaman lengkap ada di /artikel
--}}
<section class="py-24 md:py-32 bg-base-100" id="artikel">
    <div class="max-w-7xl mx-auto px-6 md:px-16">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16 md:mb-20 reveal">
            <div class="max-w-xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="h-px w-10 bg-brand"></span>
                    <span class="text-brand font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                        Artikel
                    </span>
                </div>
                <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight">
                    <span class="reveal-line"><span>Cerita &amp; Wawasan</span></span>
                </h2>
            </div>
            <a href="{{ url('/artikel') }}"
                class="inline-flex items-center gap-2 font-sans font-medium text-brand hover:gap-3 transition-all duration-300 shrink-0">
                Lihat Semua Artikel
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @php
                $articles = [
                    [
                        'image' => 'craft.webp',
                        'category' => 'Perawatan',
                        'title' => 'Cara Merawat Sarung Tenun Agar Awet',
                        'excerpt' =>
                            'Beberapa kebiasaan sederhana yang bikin motif dan warna sarung tenun tetap tajam bertahun-tahun.',
                    ],
                    [
                        'image' => 'loom.webp',
                        'category' => 'Proses',
                        'title' => 'Mengenal ATBM, Alat Tenun Warisan Pekalongan',
                        'excerpt' => 'Kenapa alat tenun bukan mesin masih dipertahankan di tengah era produksi massal.',
                    ],
                    [
                        'image' => 'lifestyle.webp',
                        'category' => 'Gaya',
                        'title' => 'Padu Padan Sarung untuk Acara Formal',
                        'excerpt' =>
                            'Tips memilih motif dan warna sarung yang pas buat berbagai acara, dari harian sampai formal.',
                    ],
                ];
            @endphp

            @foreach ($articles as $i => $article)
                <a href="{{ url('/artikel') }}" data-cursor-text="Baca"
                    class="group block tilt-card reveal reveal-delay-{{ $i + 1 }} rounded-2xl bg-base-100 border border-base-300/60 shadow-sm overflow-hidden">
                    <div class="relative overflow-hidden aspect-[3/2] reveal-image">
                        <img src="{{ asset('images/' . $article['image']) }}" alt="{{ $article['title'] }}"
                            class="parallax-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <span
                            class="absolute top-4 right-4 w-9 h-9 rounded-full bg-base-100/90 backdrop-blur-sm flex items-center justify-center opacity-0 -translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <div class="p-6">
                        <span class="text-brand font-sans text-xs tracking-[0.2em] uppercase">
                            {{ $article['category'] }}
                        </span>
                        <h3
                            class="font-serif text-lg md:text-xl font-semibold leading-snug mt-2 mb-2 group-hover:text-brand transition-colors">
                            {{ $article['title'] }}
                        </h3>
                        <p class="text-base-content/60 font-sans text-sm leading-relaxed">
                            {{ $article['excerpt'] }}
                        </p>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</section>
