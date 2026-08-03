<x-layout title="Produk Kami"
    description="Koleksi sarung tenun premium AL HIJAZ — dari Songket sampai Super, tiap motif ditenun dengan bahan dan ukuran pilihan."
    :canonical="route('produk.index')" :robots="($keyword !== '' || count($selectedCategories) > 0) ? 'noindex, follow' : 'index, follow'">
    <x-navbar />

    <main x-data="produkSearch()" x-init="init()" x-on:paginate.window="fetchResults(true, $event.detail)">

        {{-- Header — cuma judul + search, ringkas --}}
        <section class="relative pt-40 pb-20 md:pt-48 md:pb-24 overflow-hidden bg-neutral-950">
            <img src="{{ asset('images/parang-dark.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/75 to-black/90"></div>

            <div class="relative z-10 max-w-2xl mx-auto px-6 md:px-16 text-center">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <span class="h-px w-10 bg-secondary"></span>
                    <span class="text-secondary font-sans text-xs md:text-sm tracking-[0.3em] uppercase">Koleksi</span>
                    <span class="h-px w-10 bg-secondary"></span>
                </div>
                <h1 class="font-serif text-4xl md:text-6xl font-semibold text-white leading-tight mb-10">
                    Produk Kami
                </h1>

                <div class="relative max-w-xl mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/50" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" x-model="q" x-on:input="onKeywordInput()"
                        placeholder="Cari nama motif, bahan, atau deskripsi..."
                        class="w-full bg-white/10 border border-white/20 focus:border-secondary rounded-full py-3.5 pl-11 pr-5 text-white placeholder-white/50 font-sans text-sm outline-none transition-colors">
                </div>
            </div>
        </section>

        {{-- Konten: sidebar filter (nempel, gak perlu scroll balik ke atas) + grid hasil --}}
        <section class="py-16 md:py-24 bg-base-100">
            <div class="max-w-7xl mx-auto px-6 md:px-16 grid lg:grid-cols-[240px_1fr] gap-10 lg:gap-12 items-start">

                {{-- Sidebar kategori — desktop doang, nempel pas scroll --}}
                @if ($categories->isNotEmpty())
                    <aside class="hidden lg:block lg:sticky lg:top-28">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-sans text-xs font-semibold tracking-[0.2em] uppercase text-base-content/50">
                                Kategori
                            </h2>
                            <button type="button" x-show="q || kategori.length" x-cloak
                                x-on:click="q = ''; kategori = []; fetchResults();"
                                class="font-sans text-xs text-brand hover:underline">
                                Reset
                            </button>
                        </div>

                        <div class="flex flex-col gap-2">
                            @foreach ($categories as $category)
                                <button type="button" x-on:click="toggleKategori('{{ $category->slug }}')"
                                    :class="kategori.includes('{{ $category->slug }}') ?
                                        'bg-primary text-primary-content border-primary' :
                                        'bg-base-200 text-base-content/70 border-base-content/10 hover:border-brand/40'"
                                    class="w-full text-left flex items-center justify-between gap-2 px-4 py-2 rounded-lg border text-sm font-sans transition-colors">
                                    {{ $category->name }}
                                    <span class="opacity-60 text-xs">{{ $category->products_count }}</span>
                                </button>
                            @endforeach
                        </div>
                    </aside>
                @endif

                {{-- Grid hasil --}}
                <div class="relative">
                    {{-- Trigger Filter — mobile doang --}}
                    @if ($categories->isNotEmpty())
                        <div class="lg:hidden flex items-center justify-between mb-6">
                            <button type="button" x-on:click="filterSheetOpen = true"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-base-300 bg-base-200 text-sm font-sans text-base-content/80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 01.8 1.6l-4.3 5.74V16a1 1 0 01-1.45.9l-3-1.5A1 1 0 017 14.5v-4.16L3.2 4.6A1 1 0 013 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Filter
                                <span x-show="kategori.length" x-cloak
                                    class="bg-brand text-brand-content text-xs w-5 h-5 rounded-full flex items-center justify-center"
                                    x-text="kategori.length"></span>
                            </button>
                            <button type="button" x-show="q || kategori.length" x-cloak
                                x-on:click="q = ''; kategori = []; fetchResults();"
                                class="font-sans text-xs text-brand hover:underline">
                                Reset
                            </button>
                        </div>
                    @endif

                    {{-- Loading overlay — motif sama kayak entrance (benang lungsin + sekoci) --}}
                    <div x-show="loading" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 z-20 flex items-center justify-center bg-base-100/70 backdrop-blur-[2px]">
                        <div class="loom-spinner" aria-hidden="true">
                            @for ($i = 0; $i < 5; $i++)
                                <span class="loom-spinner__warp" style="--i: {{ $i }}"></span>
                            @endfor
                            <span class="loom-spinner__shuttle"></span>
                        </div>
                    </div>

                    <div id="produk-grid" :class="loading ? 'opacity-60' : ''"
                        class="grid sm:grid-cols-2 xl:grid-cols-3 gap-8 transition-opacity duration-300">
                        @include('produk.partials.grid')
                    </div>
                </div>
            </div>
        </section>

        {{-- Bottom-sheet filter — mobile doang --}}
        @if ($categories->isNotEmpty())
            <div x-show="filterSheetOpen" x-cloak class="lg:hidden fixed inset-0 z-50" style="display: none;">
                <div class="absolute inset-0 bg-black/50" x-on:click="filterSheetOpen = false"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                <div class="absolute bottom-0 left-0 right-0 bg-base-100 rounded-t-3xl px-6 pt-6 pb-8 max-h-[70vh] overflow-y-auto"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full"
                    x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-lg font-semibold">Filter Kategori</h2>
                        <button type="button" x-on:click="filterSheetOpen = false" aria-label="Tutup"
                            class="text-base-content/50 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex flex-col gap-2 mb-6">
                        @foreach ($categories as $category)
                            <button type="button" x-on:click="toggleKategori('{{ $category->slug }}')"
                                :class="kategori.includes('{{ $category->slug }}') ?
                                    'bg-primary text-primary-content border-primary' :
                                    'bg-base-200 text-base-content/70 border-base-content/10'"
                                class="w-full text-left flex items-center justify-between gap-2 px-4 py-3 rounded-lg border text-sm font-sans transition-colors">
                                {{ $category->name }}
                                <span class="opacity-60 text-xs">{{ $category->products_count }}</span>
                            </button>
                        @endforeach
                    </div>

                    <button type="button" x-on:click="filterSheetOpen = false"
                        class="w-full bg-brand text-brand-content font-sans font-semibold py-3 rounded-lg">
                        Lihat Hasil
                    </button>
                </div>
            </div>
        @endif
    </main>

    @include('sections.footer', [
        'showCta' => true,
    ])
</x-layout>
