{{--
    Section: Tentang / Filosofi
    Belum ke-connect ke DB — nanti ganti pakai Section::findByKey('tentang')
--}}
<section class="py-24 md:py-32 bg-base-100" id="tentang">
    <div class="max-w-7xl mx-auto px-6 md:px-16 grid md:grid-cols-2 gap-12 md:gap-20 items-center">

        {{-- Foto --}}
        <div class="relative order-2 md:order-1 reveal">
            <div class="relative overflow-hidden rounded-2xl aspect-[4/5] reveal-image">
                <img src="{{ asset('images/building.webp') }}" alt="Pabrik AL HIJAZ di Pekalongan"
                    class="parallax-img w-full h-full object-cover rounded-2xl" loading="lazy">
            </div>
        </div>

        {{-- Teks --}}
        <div class="order-1 md:order-2 reveal reveal-delay-1">
            <div class="flex items-center gap-3 mb-6">
                <span class="h-px w-10 bg-brand"></span>
                <span class="text-brand font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                    Filosofi Kami
                </span>
            </div>

            <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight mb-6">
                <span class="reveal-line"><span>Lebih dari Sarung,</span></span>
                <span class="reveal-line"><span>Ini Warisan</span></span>
            </h2>

            <p class="text-base-content/70 font-sans text-base md:text-lg leading-relaxed mb-8">
                Sejak awal berdiri, AL HIJAZ berkomitmen menenun sarung dengan cara yang sama
                seperti generasi sebelumnya — sabar, teliti, dan tanpa terburu-buru. Kami percaya
                kualitas tidak bisa dipercepat, dan warisan tidak bisa dipalsukan.
            </p>

            @if ($settings->owner_quote)
                <blockquote class="bg-base-content text-base-100 rounded-2xl p-6 md:p-8">
                    <p class="font-serif italic text-xl md:text-2xl mb-3">
                        &ldquo;{{ $settings->owner_quote }}&rdquo;
                    </p>
                    @if ($settings->owner_name)
                        <cite class="font-sans not-italic text-sm opacity-60 tracking-wide">
                            — {{ $settings->owner_name }}
                        </cite>
                    @endif
                </blockquote>
            @endif
        </div>

    </div>
</section>
