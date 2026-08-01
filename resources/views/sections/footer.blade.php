{{--
    Section: CTA Band + Marquee + Footer
    Belum ke-connect ke DB — nomor WA/email masih placeholder
--}}

{{-- CTA Band — disederhanain, ikut tema, gak ada tekstur berlebih --}}
<section class="py-20 md:py-28 bg-base-200">
    <div class="max-w-4xl mx-auto px-6 text-center reveal">
        <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight mb-8">
            <span class="reveal-line"><span>Siap Punya Sarung</span></span>
            <span class="reveal-line"><span class="text-brand italic font-normal">Sendiri?</span></span>
        </h2>
        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
            class="group inline-flex items-center gap-2 bg-primary text-primary-content px-10 py-5 rounded-full font-sans font-semibold tracking-wide transition-all duration-300 hover:gap-3 hover:brightness-110">
            Konsultasi via WhatsApp
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:translate-x-1"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</section>

{{-- Marquee ticker --}}
<div class="bg-secondary py-4 border-y border-secondary/30">
    <div class="marquee">
        <div class="marquee__track">
            @for ($i = 0; $i < 2; $i++)
                <span class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Tenun
                    Tangan</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                <span class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Motif
                    Otentik</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                <span
                    class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Songket</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                <span
                    class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Dobby</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                <span
                    class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Super</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                <span
                    class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Parang</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                <span class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Sejak Turun
                    Temurun</span>
                <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
            @endfor
        </div>
    </div>
</div>

{{-- Footer — editorial, wordmark raksasa jadi elemen grafis --}}
<footer class="bg-neutral-950 text-white/60">
    <div class="max-w-7xl mx-auto px-6 md:px-16 pt-20 pb-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-x-8 gap-y-12 pb-16 border-b border-white/10">

            {{-- Brand: logo, blurb, mini CTA --}}
            <div class="sm:col-span-2 lg:col-span-5">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 mb-5">
                    <x-logo-mark class="w-9 h-9 shrink-0" />
                    <span class="font-serif text-white text-lg font-semibold tracking-wide">AL HIJAZ</span>
                </a>
                <p class="font-sans text-sm leading-relaxed max-w-xs mb-6">
                    Sarung tenun premium dari Pekalongan, ditenun dengan tangan dan dijaga
                    kualitasnya dari generasi ke generasi.
                </p>
                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                    class="group inline-flex items-center gap-2 text-secondary font-sans text-sm font-medium hover:gap-3 transition-all duration-300">
                    Chat via WhatsApp
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            {{-- Jelajahi --}}
            <div class="lg:col-span-3 lg:col-start-8">
                <h4 class="font-sans text-white text-xs font-semibold tracking-[0.2em] uppercase mb-4">Jelajahi</h4>
                <ul class="space-y-3 font-sans text-sm">
                    <li><a href="#tentang" class="hover:text-secondary transition-colors">Tentang</a></li>
                    <li><a href="#katalog" class="hover:text-secondary transition-colors">Produk</a></li>
                    <li><a href="#artikel" class="hover:text-secondary transition-colors">Artikel</a></li>
                    <li><a href="#kontak" class="hover:text-secondary transition-colors">Kontak</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="lg:col-span-3">
                <h4 class="font-sans text-white text-xs font-semibold tracking-[0.2em] uppercase mb-4">Kontak</h4>
                <ul class="space-y-3 font-sans text-sm">
                    <li><a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                            class="hover:text-secondary transition-colors">+62 812-3456-7890</a></li>
                    <li><a href="mailto:info@alhijaz.test"
                            class="hover:text-secondary transition-colors">info@alhijaz.test</a>
                    </li>
                    <li>Pekalongan, Jawa Tengah</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Wordmark raksasa — elemen grafis, bukan interaktif --}}
    <div class="overflow-hidden select-none pointer-events-none" aria-hidden="true">
        <span class="block font-serif text-white/5 leading-none text-center whitespace-nowrap"
            style="font-size: clamp(3.5rem, 15vw, 11rem);">
            AL HIJAZ
        </span>
    </div>

    <div class="border-t border-white/10">
        <div
            class="max-w-7xl mx-auto px-6 md:px-16 py-6 flex flex-col-reverse md:flex-row items-center justify-between gap-3 text-xs font-sans text-center md:text-left">
            <span>&copy; {{ date('Y') }} AL HIJAZ. Semua hak cipta dilindungi.</span>
            <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"
                class="hover:text-secondary transition-colors">
                Kembali ke Atas ↑
            </a>
        </div>
    </div>
</footer>
