<x-layout :title="$product->meta_title" :description="$product->meta_description" :og-title="$product->name" :og-description="$product->meta_description" :og-image="$product->thumbnail?->image" og-type="product"
    :canonical="route('produk.show', $product)">
    <x-navbar :force-solid="true" />

    {{-- JSON-LD — biar Google bisa nampilin rich result buat produk --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->meta_description,
            'image' => $product->images->map(fn ($img) => asset('storage/' . $img->image))->values(),
            'category' => $product->category?->name,
            'brand' => ['@type' => 'Brand', 'name' => 'AL HIJAZ'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <main class="pt-24 md:pt-28 pb-16 md:pb-24 bg-base-100">
        <div class="max-w-7xl mx-auto px-6 md:px-16">

            <a href="{{ route('produk.index') }}"
                class="inline-flex items-center gap-2 text-base-content/50 hover:text-brand font-sans text-sm mb-8 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali ke Produk
            </a>

            <div class="grid lg:grid-cols-[1fr_340px] gap-12 lg:gap-16 items-start">

                {{-- Konten utama --}}
                <div>
                    @php
                        $galleryImages = $product->images->map(fn($img) => asset('storage/' . $img->image))->values();
                    @endphp

                    {{-- Galeri foto — geser (mobile), panah kiri-kanan, klik buat lightbox fullscreen --}}
                    <div x-data="{
                        active: 0,
                        images: {{ \Illuminate\Support\Js::from($galleryImages->isNotEmpty() ? $galleryImages : [asset('images/box-masterpiece.webp')]) }},
                        lightbox: false,
                        touchStartX: 0,
                        next() { this.active = (this.active + 1) % this.images.length },
                        prev() { this.active = (this.active - 1 + this.images.length) % this.images.length },
                        onTouchStart(e) { this.touchStartX = e.changedTouches[0].clientX },
                        onTouchEnd(e) {
                            const delta = e.changedTouches[0].clientX - this.touchStartX;
                            if (Math.abs(delta) > 40) { delta > 0 ? this.prev() : this.next() }
                        },
                    }" x-effect="document.body.style.overflow = lightbox ? 'hidden' : ''">
                        {{-- Gambar utama --}}
                        <div class="relative rounded-3xl overflow-hidden aspect-[4/3] mb-4 bg-base-300"
                            x-on:touchstart="onTouchStart($event)" x-on:touchend="onTouchEnd($event)">
                            <img :src="images[active]" alt="{{ $product->name }}" data-cursor-text="Perbesar"
                                class="w-full h-full object-cover cursor-zoom-in select-none"
                                x-on:click="lightbox = true" loading="eager" draggable="false">

                            <button type="button" x-show="images.length > 1" x-cloak x-on:click="prev()"
                                data-cursor-text="Sebelumnya"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-base-100/80 backdrop-blur-sm flex items-center justify-center hover:bg-base-100 transition-colors"
                                aria-label="Foto sebelumnya">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L8.414 10l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button type="button" x-show="images.length > 1" x-cloak x-on:click="next()"
                                data-cursor-text="Selanjutnya"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-base-100/80 backdrop-blur-sm flex items-center justify-center hover:bg-base-100 transition-colors"
                                aria-label="Foto selanjutnya">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L11.586 10 7.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <span x-show="images.length > 1" x-cloak x-text="`${active + 1} / ${images.length}`"
                                class="absolute bottom-3 right-3 bg-base-100/80 backdrop-blur-sm text-base-content text-xs font-sans px-2.5 py-1 rounded-full">
                            </span>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="flex gap-3 overflow-x-auto pb-1" x-show="images.length > 1">
                            <template x-for="(image, i) in images" :key="i">
                                <button type="button" x-on:click="active = i"
                                    :class="active === i ? 'border-brand' : 'border-transparent opacity-60 hover:opacity-100'"
                                    class="w-16 h-16 shrink-0 rounded-lg overflow-hidden border-2 transition-all">
                                    <img :src="image" alt="" class="w-full h-full object-cover">
                                </button>
                            </template>
                        </div>

                        {{-- Lightbox fullscreen --}}
                        <div x-show="lightbox" x-cloak x-on:keydown.escape.window="lightbox = false"
                            x-on:touchstart="onTouchStart($event)" x-on:touchend="onTouchEnd($event)"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="fixed inset-0 z-[9999] bg-neutral-950/95 flex items-center justify-center px-4">
                            <button type="button" x-on:click="lightbox = false" data-cursor-text="Tutup"
                                class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors"
                                aria-label="Tutup">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <img :src="images[active]" alt="{{ $product->name }}"
                                class="max-w-[90vw] max-h-[85vh] object-contain select-none" draggable="false">

                            <button type="button" x-show="images.length > 1" x-on:click="prev()"
                                data-cursor-text="Sebelumnya"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors"
                                aria-label="Foto sebelumnya">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L8.414 10l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button type="button" x-show="images.length > 1" x-on:click="next()"
                                data-cursor-text="Selanjutnya"
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors"
                                aria-label="Foto selanjutnya">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L11.586 10 7.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <span x-show="images.length > 1" x-text="`${active + 1} / ${images.length}`"
                                class="absolute bottom-6 text-white/60 text-sm font-sans"></span>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 mt-8 mb-5">
                        @if ($product->category)
                            <span
                                class="inline-block bg-brand/10 text-brand font-sans text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full">
                                {{ $product->category->name }}
                            </span>
                        @endif
                        @if ($product->edition)
                            <span
                                class="inline-block bg-secondary/20 text-brand font-sans text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full">
                                Edisi {{ $product->edition }}
                            </span>
                        @endif
                    </div>

                    <h1 class="font-serif text-3xl md:text-5xl font-bold text-base-content leading-tight mb-4">
                        {{ $product->name }}
                    </h1>

                    @if ($product->spec_label)
                        <p class="font-sans text-base-content/60 mb-8">
                            {{ $product->spec_label }}
                        </p>
                    @endif

                    @if ($product->whatsapp_inquiry_url)
                        <a href="{{ $product->whatsapp_inquiry_url }}" target="_blank" rel="noopener"
                            data-cursor-text="Chat"
                            class="inline-flex items-center gap-2 bg-primary text-primary-content font-sans font-semibold px-6 py-3.5 rounded-lg hover:brightness-110 transition-all mb-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                            Tanya soal produk ini
                        </a>
                    @endif

                    @if ($product->description)
                        <div class="prose prose-hijaz max-w-none">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @endif

                    <div
                        class="mt-16 pt-8 border-t border-base-300 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="font-serif italic text-lg text-base-content/70">
                            Suka motif ini? Bagikan ke yang lain.
                        </p>
                        <x-share-buttons :url="url()->current()" :title="$product->name" />
                    </div>
                </div>

                {{-- Sidebar — produk lainnya, nempel pas scroll --}}
                @if ($related->isNotEmpty())
                    <aside class="lg:sticky lg:top-28">
                        <div class="rounded-2xl bg-neutral-950 px-6 py-5 mb-6">
                            <h2 class="font-serif text-lg font-semibold text-white">Motif Lainnya</h2>
                        </div>

                        <div class="space-y-5 border-base-300 border-1 rounded-2xl">
                            @foreach ($related as $item)
                                <a href="{{ route('produk.show', $item) }}" data-cursor-text="Lihat"
                                    class="flex gap-4 group">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0 bg-base-300">
                                        <img src="{{ $item->thumbnail?->image ? asset('storage/' . $item->thumbnail->image) : asset('images/box-masterpiece.webp') }}"
                                            alt="{{ $item->name }}" class="w-full h-full object-cover"
                                            loading="lazy">
                                    </div>
                                    <div class="min-w-0">
                                        <h3
                                            class="font-serif text-md font-semibold leading-snug line-clamp-2 group-hover:text-brand transition-colors">
                                            {{ $item->name }}
                                        </h3>
                                        @if ($item->spec_label)
                                            <p class="font-sans text-xs text-base-content mt-1 line-clamp-2">
                                                {{ $item->spec_label }}
                                            </p>
                                        @endif
                                        @if ($item->category)
                                            <p class="font-sans text-xs text-base-content/80 mt-1.5">
                                                {{ $item->category->name }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    </main>

    @include('sections.footer', [
        'showCta' => false,
    ])
</x-layout>
