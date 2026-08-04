@if (!$products->isEmpty())
    <p class="col-span-full font-sans text-sm text-base-content/50 mb-2">
        {{ $products->total() }} produk ditemukan
        @if ($keyword !== '')
            untuk "<span class="text-base-content/70">{{ $keyword }}</span>"
        @endif
    </p>
@endif

@if ($products->isEmpty())
    <div class="col-span-full py-20 text-center">
        <p class="font-serif text-xl md:text-2xl mb-2">Produk tidak ditemukan</p>
        <p class="text-base-content/60 font-sans text-sm">
            Coba kata kunci lain atau hapus sebagian filter kategori.
        </p>
    </div>
@else
    @foreach ($products as $i => $product)
        <a href="{{ route('produk.show', $product) }}" data-cursor-text="Lihat"
            class="group block tilt-card reveal reveal-delay-{{ ($i % 3) + 1 }} rounded-2xl bg-base-100 border border-base-300/60 shadow-sm overflow-hidden">
            <div class="relative overflow-hidden aspect-[4/3] reveal-image bg-base-300">
                <img src="{{ $product->thumbnail?->image ? asset('storage/' . $product->thumbnail->image) : asset('images/box-masterpiece.webp') }}"
                    alt="{{ $product->name }}"
                    class="parallax-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
            </div>
            <div class="p-6">
                <h3 class="font-serif text-lg md:text-xl font-semibold leading-snug">
                    @if ($keyword !== '' && isset($product->name_highlighted))
                        {!! $product->name_highlighted !!}
                    @else
                        {{ $product->name }}
                    @endif
                </h3>
                @if ($product->category)
                    <span class="text-brand font-sans text-sm font-medium">
                        {{ $product->category->name }}
                    </span>
                @endif

                @if ($product->spec_label)
                    <p class="text-base-content/60 font-sans text-sm leading-relaxed mt-3">
                        {{ $product->spec_label }}
                    </p>
                @endif

                @if (!empty($product->search_snippet))
                    <p class="text-base-content/50 font-sans text-sm leading-relaxed mt-2">
                        {!! $product->search_snippet !!}
                    </p>
                @elseif ($product->excerpt)
                    <p class="text-base-content/50 font-sans text-sm leading-relaxed mt-2">
                        {{ $product->excerpt }}
                    </p>
                @endif

                @if ($product->edition)
                    <span
                        class="inline-block mt-4 bg-secondary/20 text-brand font-sans text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded-full">
                        Edisi {{ $product->edition }}
                    </span>
                @endif
            </div>
        </a>
    @endforeach
@endif

@if ($products->hasPages())
    <div class="col-span-full flex items-center justify-center gap-4 pt-8 font-sans text-sm">
        @if ($products->onFirstPage())
            <span class="px-4 py-2 text-base-content/30">&larr; Sebelumnya</span>
        @else
            <button type="button" data-page-url="{{ $products->previousPageUrl() }}"
                onclick="document.getElementById('produk-grid').dispatchEvent(new CustomEvent('paginate', { detail: this.dataset.pageUrl, bubbles: true }))"
                class="px-4 py-2 rounded-full border border-base-300/60 hover:border-brand hover:text-brand transition-colors">
                &larr; Sebelumnya
            </button>
        @endif

        <span class="text-base-content/60">
            Halaman {{ $products->currentPage() }} dari {{ $products->lastPage() }}
        </span>

        @if ($products->hasMorePages())
            <button type="button" data-page-url="{{ $products->nextPageUrl() }}"
                onclick="document.getElementById('produk-grid').dispatchEvent(new CustomEvent('paginate', { detail: this.dataset.pageUrl, bubbles: true }))"
                class="px-4 py-2 rounded-full border border-base-300/60 hover:border-brand hover:text-brand transition-colors">
                Selanjutnya &rarr;
            </button>
        @else
            <span class="px-4 py-2 text-base-content/30">Selanjutnya &rarr;</span>
        @endif
    </div>
@endif
