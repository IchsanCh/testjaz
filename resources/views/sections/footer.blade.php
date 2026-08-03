{{--
    Section: CTA Band + Marquee + Footer
    Belum ke-connect ke DB — nomor WA/email masih placeholder
--}}
@props([
    'showCta' => true,
])
{{-- CTA Band — disederhanain, ikut tema, gak ada tekstur berlebih --}}
@if ($showCta)
    <section class="py-20 md:py-28 bg-base-200">
        <div class="max-w-4xl mx-auto px-6 text-center reveal">
            <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight mb-8">
                <span class="reveal-line"><span>Siap Punya Sarung</span></span>
                <span class="reveal-line"><span class="text-brand italic font-normal">Sendiri?</span></span>
            </h2>
            <a href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank" rel="noopener"
                aria-label="WhatsApp Hijaz"
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
                    <span class="font-serif italic text-secondary-content text-xl md:text-2xl whitespace-nowrap">Sejak
                        Turun
                        Temurun</span>
                    <span class="font-sans text-secondary-content/50 text-xl">&middot;</span>
                @endfor
            </div>
        </div>
    </div>
@endif


{{-- Footer — editorial, wordmark raksasa jadi elemen grafis --}}
<footer class="bg-neutral-950 text-white/60">
    <div class="max-w-7xl mx-auto px-6 md:px-16 pt-8">
        <div class="flex flex-col lg:flex-row lg:justify-between pb-8 border-b border-white/10">

            {{-- Brand: logo, blurb, mini CTA --}}
            <div class="max-w-sm">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 mb-5">
                    <x-logo-mark class="w-9 h-9 shrink-0" />
                    <span class="font-serif text-white text-lg font-semibold tracking-wide">AL HIJAZ</span>
                </a>
                <p class="font-sans text-sm leading-relaxed max-w-xs mb-6">
                    Sarung tenun premium dari Pekalongan, ditenun dengan tangan dan dijaga
                    kualitasnya dari generasi ke generasi.
                </p>
                <a href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank" rel="noopener"
                    aria-label="WhatsApp Hijaz"
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
            <div>
                <h4 class="font-sans text-white text-xs font-semibold tracking-[0.2em] uppercase mb-4">Jelajahi</h4>
                <ul class="space-y-3 font-sans text-sm">
                    <li><a href="/#tentang" aria-label="Tentang Al Hijaz"
                            class="hover:text-secondary transition-colors">Tentang</a></li>
                    <li><a href="#katalog" aria-label="Katalog Produk"
                            class="hover:text-secondary transition-colors">Produk</a></li>
                    <li><a href="{{ route('artikel.index') }}" aria-label="Artikel"
                            class="hover:text-secondary transition-colors">Artikel</a></li>
                    <li><a href="/#kontak" aria-label="Kontak" class="hover:text-secondary transition-colors">Kontak</a>
                    </li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="font-sans text-white text-xs font-semibold tracking-[0.2em] uppercase mb-4">Kontak</h4>
                <ul class="space-y-3 font-sans text-sm">
                    @if ($settings->whatsapp_number)
                        <li><a href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank" rel="noopener"
                                aria-label="WhatsApp Hijaz"
                                class="hover:text-secondary transition-colors">{{ $settings->whatsapp_number_formatted }}</a>
                        </li>
                    @endif
                    @if ($settings->email)
                        <li><a href="mailto:{{ $settings->email }}" target="_blank" rel="noopener"
                                aria-label="Email Hijaz"
                                class="hover:text-secondary transition-colors">{{ $settings->email }}</a>
                        </li>
                    @endif
                    @if ($settings->address)
                        <li>
                            @if ($settings->google_maps_url)
                                <a href="{{ $settings->google_maps_url }}" target="_blank" rel="noopener"
                                    aria-label="Lokasi Hijaz"
                                    class="hover:text-secondary transition-colors">{{ $settings->address }}</a>
                            @else
                                {{ $settings->address }}
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div
            class="max-w-7xl mx-auto px-6 md:px-16 py-6 flex flex-col-reverse md:flex-row items-center justify-between gap-3 text-xs font-sans text-center md:text-left">
            <span>&copy; {{ date('Y') }} AL HIJAZ. All Rights Reserved.</span>
            <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"
                class="hover:text-secondary transition-colors flex flex-row-reverse">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                </svg>
                Kembali ke Atas
            </a>
        </div>
    </div>
</footer>
