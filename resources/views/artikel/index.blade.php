<x-layout>
    <x-navbar />

    <main x-data="artikelSearch()" x-init="init()" x-on:paginate.window="fetchResults(true, $event.detail)">

        {{-- Header --}}
        <section class="relative pt-40 pb-16 md:pt-48 md:pb-20 overflow-hidden bg-neutral-950">
            <img src="{{ asset('images/hero-yarn.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/75 to-black/90"></div>

            <div class="relative z-10 max-w-3xl mx-auto px-6 md:px-16 text-center">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <span class="h-px w-10 bg-secondary"></span>
                    <span class="text-secondary font-sans text-xs md:text-sm tracking-[0.3em] uppercase">Artikel</span>
                    <span class="h-px w-10 bg-secondary"></span>
                </div>
                <h1 class="font-serif text-4xl md:text-6xl font-semibold text-white leading-tight mb-10">
                    Cerita &amp; Wawasan
                </h1>

                {{-- Search --}}
                <div class="relative max-w-xl mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/50" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" x-model="q" x-on:input="onKeywordInput()"
                        placeholder="Cari judul artikel..."
                        class="w-full bg-white/10 border border-white/20 focus:border-secondary rounded-full py-3.5 pl-11 pr-5 text-white placeholder-white/50 font-sans text-sm outline-none transition-colors">
                </div>

                {{-- Filter kategori — multi-select --}}
                @if ($categories->isNotEmpty())
                    <div class="flex flex-wrap items-center justify-center gap-2">
                        @foreach ($categories as $category)
                            <button type="button" x-on:click="toggleKategori('{{ $category->slug }}')"
                                :class="kategori.includes('{{ $category->slug }}') ?
                                    'bg-secondary text-neutral-900 border-secondary' :
                                    'bg-white/5 text-white/70 border-white/20 hover:border-white/40'"
                                class="px-4 py-1.5 rounded-full border text-xs font-sans transition-colors">
                                {{ $category->name }}
                                <span class="opacity-60">({{ $category->published_articles_count }})</span>
                            </button>
                        @endforeach

                        <button type="button" x-show="q || kategori.length" x-cloak
                            x-on:click="q = ''; kategori = []; fetchResults();"
                            class="px-4 py-1.5 rounded-full text-xs font-sans text-white/50 hover:text-white transition-colors">
                            Reset &times;
                        </button>
                    </div>
                @endif
            </div>
        </section>

        {{-- Grid --}}
        <section class="py-20 md:py-28 bg-base-100">
            <div class="max-w-7xl mx-auto px-6 md:px-16">
                <div class="relative">
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

                    <div id="artikel-grid" :class="loading ? 'opacity-60' : ''"
                        class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 transition-opacity duration-300">
                        @include('artikel.partials.grid')
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('sections.footer')
</x-layout>
