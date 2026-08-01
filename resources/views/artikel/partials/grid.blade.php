@if (!$articles->isEmpty())
    <p class="col-span-full font-sans text-sm text-base-content/50 mb-2">
        {{ $articles->total() }} artikel ditemukan
        @if ($keyword !== '')
            untuk "<span class="text-base-content/70">{{ $keyword }}</span>"
        @endif
    </p>
@endif

@if ($articles->isEmpty())
    <div class="col-span-full py-20 text-center">
        <p class="font-serif text-xl md:text-2xl mb-2">Artikel tidak ditemukan</p>
        <p class="text-base-content/60 font-sans text-sm">
            Coba kata kunci lain atau hapus sebagian filter kategori.
        </p>
    </div>
@else
    @foreach ($articles as $i => $article)
        <a href="{{ route('artikel.show', $article) }}" data-cursor-text="Baca"
            class="group block tilt-card reveal reveal-delay-{{ ($i % 3) + 1 }} rounded-2xl bg-base-100 border border-base-300/60 shadow-sm overflow-hidden">
            <div class="relative overflow-hidden aspect-[3/2] reveal-image">
                <img src="{{ $article->cover_image ? asset('storage/' . $article->cover_image) : asset('images/craft.webp') }}"
                    alt="{{ $article->title }}"
                    class="parallax-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <span
                    class="absolute top-4 right-4 w-9 h-9 rounded-full bg-base-100/90 backdrop-blur-sm flex items-center justify-center opacity-0 -translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
            <div class="p-6">
                @if ($article->category)
                    <span class="text-brand font-sans text-xs tracking-[0.2em] uppercase">
                        {{ $article->category->name }}
                    </span>
                @endif
                <h3
                    class="font-serif text-lg md:text-xl font-semibold leading-snug mt-2 mb-2 group-hover:text-brand transition-colors">
                    @if ($keyword !== '' && isset($article->title_highlighted))
                        {!! $article->title_highlighted !!}
                    @else
                        {{ $article->title }}
                    @endif
                </h3>
                @if (!empty($article->search_snippet))
                    <p class="text-base-content/60 font-sans text-sm leading-relaxed">
                        {!! $article->search_snippet !!}
                    </p>
                @else
                    <p class="text-base-content/60 font-sans text-sm leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                @endif
            </div>
        </a>
    @endforeach
@endif

@if ($articles->hasPages())
    <div class="col-span-full flex items-center justify-center gap-4 pt-8 font-sans text-sm">
        @if ($articles->onFirstPage())
            <span class="px-4 py-2 text-base-content/30">&larr; Sebelumnya</span>
        @else
            <button type="button" data-page-url="{{ $articles->previousPageUrl() }}"
                onclick="document.getElementById('artikel-grid').dispatchEvent(new CustomEvent('paginate', { detail: this.dataset.pageUrl, bubbles: true }))"
                class="px-4 py-2 rounded-full border border-base-300/60 hover:border-brand hover:text-brand transition-colors">
                &larr; Sebelumnya
            </button>
        @endif

        <span class="text-base-content/60">
            Halaman {{ $articles->currentPage() }} dari {{ $articles->lastPage() }}
        </span>

        @if ($articles->hasMorePages())
            <button type="button" data-page-url="{{ $articles->nextPageUrl() }}"
                onclick="document.getElementById('artikel-grid').dispatchEvent(new CustomEvent('paginate', { detail: this.dataset.pageUrl, bubbles: true }))"
                class="px-4 py-2 rounded-full border border-base-300/60 hover:border-brand hover:text-brand transition-colors">
                Selanjutnya &rarr;
            </button>
        @else
            <span class="px-4 py-2 text-base-content/30">Selanjutnya &rarr;</span>
        @endif
    </div>
@endif
