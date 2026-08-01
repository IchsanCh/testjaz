{{--
    Section: Hero
    Belum ke-connect ke DB — konten masih hardcoded di bawah.
    Nanti tinggal ganti isinya dari $heroContent (HeroContent::current()) & sections('tentang') dst.
--}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-neutral-950">
    {{-- Background image + overlay gelap tegas --}}
    <img src="{{ asset('images/hero-yarn.webp') }}" alt="Gulungan benang tenun AL HIJAZ"
        class="absolute inset-0 w-full h-full object-cover opacity-70" loading="eager" fetchpriority="high">
    <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/70 to-black/40"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full px-6 md:px-16 max-w-7xl mx-auto">
        <div class="max-w-2xl pt-28 md:pt-16">
            <div class="flex items-center gap-3 mb-6">
                <span class="h-px w-10 bg-secondary"></span>
                <span class="text-secondary font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                    Sarung Tenun Premium — Pekalongan
                </span>
            </div>

            <h1
                class="font-serif text-white text-5xl md:text-7xl lg:text-8xl font-semibold leading-[0.98] mb-8 tracking-tight">
                <span class="reveal-line"><span>Ditenun</span></span>
                <span class="reveal-line"><span class="text-secondary italic font-normal">Perlahan.</span></span>
                <span class="reveal-line"><span>Dijaga Turun Temurun.</span></span>
            </h1>

            <p class="text-white/70 font-sans text-lg md:text-xl max-w-lg mb-10 leading-relaxed">
                Setiap helai AL HIJAZ dirangkai dari benang pilihan, ditenun oleh tangan-tangan
                berpengalaman — untuk sarung yang menemani setiap langkah dan setiap ibadah.
            </p>

            <div class="flex flex-wrap items-center gap-4 mb-4">
                <a href="#katalog"
                    class="group inline-flex items-center gap-2 bg-secondary text-neutral-900 px-8 py-4 rounded-full font-sans font-semibold text-sm md:text-base tracking-wide transition-all duration-300 hover:gap-3 hover:brightness-110">
                    Lihat Koleksi
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 border border-white/30 backdrop-blur-sm text-white px-8 py-4 rounded-full font-sans font-medium text-sm md:text-base tracking-wide transition-colors duration-300 hover:bg-white/10 hover:border-white/50">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
