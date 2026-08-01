{{--
    Section: Kenapa Pilih Kami
    Belum ke-connect ke DB — nanti diambil dari SectionItem yang section_id-nya "kenapa_pilih"
--}}
<section class="py-24 md:py-32 bg-base-200" id="kenapa-pilih">
    <div class="max-w-7xl mx-auto px-6 md:px-16">

        <div class="max-w-2xl mb-16 md:mb-20 reveal">
            <div class="flex items-center gap-3 mb-6">
                <span class="h-px w-10 bg-brand"></span>
                <span class="text-brand font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                    Kenapa AL HIJAZ
                </span>
            </div>
            <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight">
                <span class="reveal-line"><span>Detail yang Kami Jaga</span></span>
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @php
                $items = [
                    [
                        'image' => 'box-masterpiece.webp',
                        'title' => 'Kemasan Elegan',
                        'desc' =>
                            'Setiap sarung dikemas rapi dalam boks eksklusif, siap jadi hadiah atau koleksi pribadi.',
                    ],
                    [
                        'image' => 'parang-dark.webp',
                        'title' => 'Motif Otentik',
                        'desc' =>
                            'Motif ditenun detail per detail, bukan dicetak — warna dan tekstur terasa sampai serat kain.',
                    ],
                    [
                        'image' => 'lifestyle.webp',
                        'title' => 'Nyaman Dipakai',
                        'desc' =>
                            'Dirancang untuk dipakai sehari-hari maupun momen ibadah, ringan dan tetap terlihat rapi.',
                    ],
                ];
            @endphp

            @foreach ($items as $i => $item)
                <div class="bg-base-100 rounded-2xl overflow-hidden reveal reveal-delay-{{ $i + 1 }}">
                    <div class="relative aspect-[4/3] overflow-hidden reveal-image">
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}"
                            class="parallax-img w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6 md:p-8">
                        <h3 class="font-serif text-xl md:text-2xl font-semibold mb-3">
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-base-content/70 font-sans text-sm md:text-base leading-relaxed">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
