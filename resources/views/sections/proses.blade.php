{{--
    Section: Proses
    Belum ke-connect ke DB — nanti step-nya diambil dari SectionItem::where('section_id', ...)
--}}
<section class="py-24 md:py-32 bg-base-200" id="proses">
    <div class="max-w-7xl mx-auto px-6 md:px-16">

        <div class="max-w-2xl mb-16 md:mb-20 reveal">
            <div class="flex items-center gap-3 mb-6">
                <span class="h-px w-10 bg-brand"></span>
                <span class="text-brand font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                    Proses
                </span>
            </div>
            <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight">
                <span class="reveal-line"><span>Dari Benang, Menjadi Cerita</span></span>
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-10 md:gap-8">

            @php
                $steps = [
                    [
                        'image' => 'yarn-rolls.webp',
                        'number' => '01',
                        'title' => 'Pemilihan Benang',
                        'desc' =>
                            'Benang dipilih dari bahan berkualitas, disortir warna dan teksturnya sebelum masuk proses tenun.',
                    ],
                    [
                        'image' => 'loom.webp',
                        'number' => '02',
                        'title' => 'Ditenun Perlahan',
                        'desc' =>
                            'Setiap helai ditenun di alat tenun bukan mesin (ATBM), menjaga tekstur dan detail motif tetap presisi.',
                    ],
                    [
                        'image' => 'craft.webp',
                        'number' => '03',
                        'title' => 'Sentuhan Akhir',
                        'desc' =>
                            'Pengrajin merapikan tiap jahitan dan detail motif dengan tangan, memastikan setiap sarung siap dipakai sempurna.',
                    ],
                ];
            @endphp

            @foreach ($steps as $i => $step)
                <div class="group reveal reveal-delay-{{ $i + 1 }}">
                    <div class="relative overflow-hidden rounded-2xl mb-6 aspect-[4/5]">
                        <img src="{{ asset('images/' . $step['image']) }}" alt="{{ $step['title'] }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy">
                        <span class="absolute top-4 left-4 font-serif text-white/90 text-4xl font-semibold drop-shadow">
                            {{ $step['number'] }}
                        </span>
                    </div>
                    <h3 class="font-serif text-xl md:text-2xl font-semibold mb-2">
                        {{ $step['title'] }}
                    </h3>
                    <p class="text-base-content/70 font-sans text-sm md:text-base leading-relaxed">
                        {{ $step['desc'] }}
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</section>
