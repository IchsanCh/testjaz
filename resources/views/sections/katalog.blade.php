{{--
    Section: Katalog Produk (highlight)
    Konek ke DB — $featuredProducts dari HomeController::index()
    Halaman lengkap (semua produk + filter kategori) ada di /produk, link di tombol bawah
--}}
<section class="py-24 md:py-32 bg-base-100" id="katalog">
    <div class="max-w-7xl mx-auto px-6 md:px-16">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16 md:mb-20 reveal">
            <div class="max-w-xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="h-px w-10 bg-brand"></span>
                    <span class="text-brand font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                        Koleksi
                    </span>
                </div>
                <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight">
                    <span class="reveal-line"><span>Motif Pilihan Kami</span></span>
                </h2>
            </div>
            <a href="{{ route('produk.index') }}"
                class="inline-flex items-center gap-2 font-sans font-medium text-brand hover:gap-3 transition-all duration-300 shrink-0">
                Lihat Semua Produk
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach ($featuredProducts as $i => $product)
                <a href="{{ route('produk.show', $product) }}" data-cursor-text="Lihat"
                    class="group block tilt-card reveal reveal-delay-{{ ($i % 3) + 1 }}">
                    <div class="relative overflow-hidden rounded-2xl aspect-[4/5] bg-transparent reveal-image">
                        <img src="{{ $product->thumbnail?->image ? asset('storage/' . $product->thumbnail->image) : asset('images/box-masterpiece.webp') }}"
                            alt="Sarung motif {{ $product->name }}"
                            class="parallax-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                        </div>
                        <span class="absolute bottom-4 left-4 font-serif text-white text-xl font-semibold">
                            {{ $product->name }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
