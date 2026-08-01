<x-layout :title="($article->meta_title ?? $article->title) . ' — AL HIJAZ'" :description="$article->meta_description" :og-title="$article->title" :og-description="$article->meta_description" :og-image="$article->cover_image">
    <x-navbar />

    <main>
        {{-- Header --}}
        <section class="relative pt-40 pb-16 md:pt-48 md:pb-20 overflow-hidden bg-neutral-950">
            <img src="{{ $article->cover_image ? asset('storage/' . $article->cover_image) : asset('images/craft.webp') }}"
                alt="{{ $article->title }}" class="absolute inset-0 w-full h-full object-cover opacity-40" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/75 to-black/90"></div>

            <div class="relative z-10 max-w-3xl mx-auto px-6 md:px-16 text-center">
                <a href="{{ route('artikel.index') }}"
                    class="inline-flex items-center gap-2 text-white/60 hover:text-white font-sans text-sm mb-8 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali ke Artikel
                </a>

                @if ($article->category)
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <span class="h-px w-10 bg-secondary"></span>
                        <span class="text-secondary font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                            {{ $article->category->name }}
                        </span>
                        <span class="h-px w-10 bg-secondary"></span>
                    </div>
                @endif

                <h1 class="font-serif text-3xl md:text-5xl font-semibold text-white leading-tight">
                    {{ $article->title }}
                </h1>
                <p class="text-white/50 font-sans text-sm mt-6">
                    {{ $article->updated_at->locale('id')->translatedFormat('d F Y') }}
                    &middot; AL HIJAZ
                </p>
            </div>
        </section>

        {{-- Konten --}}
        <section class="py-16 md:py-24 bg-base-100">
            <div class="max-w-3xl mx-auto px-6 md:px-16">

                {{-- Share — atas, sebelum mulai baca --}}
                <div class="flex justify-end mb-8">
                    <x-share-buttons :url="url()->current()" :title="$article->title" />
                </div>

                <div class="prose prose-hijaz max-w-none prose-lg">
                    {!! $article->content !!}
                </div>

                {{-- Share — bawah lagi, banyak orang share abis kelar baca --}}
                <div
                    class="mt-16 pt-8 border-t border-base-300/60 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <p class="font-serif italic text-lg text-base-content/70">
                        Suka artikel ini? Bagikan ke yang lain.
                    </p>
                    <x-share-buttons :url="url()->current()" :title="$article->title" />
                </div>
            </div>
        </section>

        {{-- Artikel terkait --}}
        @if ($related->isNotEmpty())
            <section class="py-16 md:py-24 bg-base-200 border-t border-base-300/60">
                <div class="max-w-7xl mx-auto px-6 md:px-16">
                    <h2 class="font-serif text-2xl md:text-3xl font-semibold mb-10">Artikel Terkait</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($related as $item)
                            <a href="{{ route('artikel.show', $item) }}" data-cursor-text="Baca"
                                class="group block tilt-card rounded-2xl bg-base-100 border border-base-300/60 shadow-sm overflow-hidden">
                                <div class="relative overflow-hidden aspect-[3/2]">
                                    <img src="{{ $item->cover_image ? asset('storage/' . $item->cover_image) : asset('images/craft.webp') }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy">
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="font-serif text-lg font-semibold leading-snug group-hover:text-brand transition-colors">
                                        {{ $item->title }}
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    @include('sections.footer')
</x-layout>
