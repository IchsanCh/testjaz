<x-layout title="Artikel & Wawasan — AL HIJAZ"
    description="Cerita, proses, dan tips seputar sarung tenun dari AL HIJAZ — dari perawatan kain sampai perjalanan benang jadi motif.">
    <x-navbar />

    <main x-data="artikelSearch()" x-init="init()" x-on:paginate.window="fetchResults(true, $event.detail)">

        {{-- Header — cuma judul + search, ringkas --}}
        <section class="relative pt-40 pb-20 md:pt-48 md:pb-24 overflow-hidden bg-neutral-950">
            <img src="{{ asset('images/hero-yarn.webp') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/75 to-black/90"></div>

            <div class="relative z-10 max-w-2xl mx-auto px-6 md:px-16 text-center">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <span class="h-px w-10 bg-secondary"></span>
                    <span class="text-secondary font-sans text-xs md:text-sm tracking-[0.3em] uppercase">Artikel</span>
                    <span class="h-px w-10 bg-secondary"></span>
                </div>
                <h1 class="font-serif text-4xl md:text-6xl font-semibold text-white leading-tight mb-10">
                    Cerita &amp; Wawasan
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
                        placeholder="Cari judul atau isi artikel..."
                        class="w-full bg-white/10 border border-white/20 focus:border-secondary rounded-full py-3.5 pl-11 pr-5 text-white placeholder-white/50 font-sans text-sm outline-none transition-colors">
                </div>
            </div>
        </section>

        {{-- Konten: sidebar filter (nempel, gak perlu scroll balik ke atas) + grid hasil --}}
        <section class="py-16 md:py-24 bg-base-100">
            <div class="max-w-7xl mx-auto px-6 md:px-16 grid lg:grid-cols-[240px_1fr] gap-10 lg:gap-12 items-start">

                {{-- Sidebar kategori --}}
                @if ($categories->isNotEmpty())
                    <aside class="lg:sticky lg:top-28">
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

                        {{-- Mobile: scroll horizontal chip. Desktop: list vertikal nempel --}}
                        <div
                            class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 -mx-6 px-6 lg:mx-0 lg:px-0">
                            @foreach ($categories as $category)
                                <button type="button" x-on:click="toggleKategori('{{ $category->slug }}')"
                                    :class="kategori.includes('{{ $category->slug }}') ?
                                        'bg-primary text-primary-content border-primary' :
                                        'bg-base-200 text-base-content/70 border-base-content/10 hover:border-brand/40'"
                                    class="shrink-0 lg:w-full lg:text-left flex items-center justify-between gap-2 px-4 py-2 rounded-full lg:rounded-lg border text-sm font-sans transition-colors whitespace-nowrap">
                                    {{ $category->name }}
                                    <span class="opacity-60 text-xs">{{ $category->published_articles_count }}</span>
                                </button>
                            @endforeach
                        </div>
                    </aside>
                @endif

                {{-- Grid hasil --}}
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
                        class="grid sm:grid-cols-2 gap-8 transition-opacity duration-300">
                        @include('artikel.partials.grid')
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('sections.footer')
</x-layout>
