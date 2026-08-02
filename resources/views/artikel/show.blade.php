<x-layout :title="$article->meta_title ?? $article->title" :description="$article->meta_description" :og-title="$article->title" :og-description="$article->meta_description" :og-image="$article->cover_image" og-type="article"
    :canonical="route('artikel.show', $article)" :published-time="$article->created_at->toAtomString()" :modified-time="$article->updated_at->toAtomString()" :article-section="$article->category?->name">
    <x-navbar :force-solid="true" />

    {{-- JSON-LD — biar Google bisa nampilin rich result (tanggal, gambar, dll) --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => $article->meta_description,
            'image' => $article->cover_image ? asset('storage/' . $article->cover_image) : asset('images/craft.webp'),
            'datePublished' => $article->created_at->toAtomString(),
            'dateModified' => $article->updated_at->toAtomString(),
            'author' => ['@type' => 'Organization', 'name' => 'AL HIJAZ'],
            'publisher' => ['@type' => 'Organization', 'name' => 'AL HIJAZ'],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('artikel.show', $article)],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <main class="pt-32 md:pt-40 pb-16 md:pb-24 bg-base-100">
        <div class="max-w-7xl mx-auto px-6 md:px-16">

            <a href="{{ route('artikel.index') }}"
                class="inline-flex items-center gap-2 text-base-content/50 hover:text-brand font-sans text-sm mb-8 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali ke Artikel
            </a>

            <div class="grid lg:grid-cols-[1fr_340px] gap-12 lg:gap-16 items-start">

                {{-- Konten utama --}}
                <div>
                    <div class="rounded-3xl overflow-hidden aspect-[16/10] mb-8 bg-base-300">
                        <img src="{{ $article->cover_image ? asset('storage/' . $article->cover_image) : asset('images/craft.webp') }}"
                            alt="{{ $article->title }}" class="w-full h-full object-cover" loading="eager">
                    </div>

                    <div class="flex flex-wrap items-center gap-3 mb-5">
                        @if ($article->category)
                            <span
                                class="inline-block bg-brand/10 text-brand font-sans text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full">
                                {{ $article->category->name }}
                            </span>
                        @endif
                        <span class="text-base-content/40 font-sans text-sm">
                            {{ $article->updated_at->locale('id')->translatedFormat('d M Y') }}
                            &middot; {{ $article->reading_time }} menit baca
                        </span>
                    </div>

                    <h1 class="font-serif text-3xl md:text-5xl font-bold text-base-content leading-tight mb-8">
                        {{ $article->title }}
                    </h1>

                    <div class="flex items-center justify-between border-y border-base-300 py-4 mb-10">
                        <span class="font-sans text-sm text-base-content/50">AL HIJAZ</span>
                        <x-share-buttons :url="url()->current()" :title="$article->title" />
                    </div>

                    <div class="prose prose-hijaz max-w-none prose-lg">
                        {!! $article->content !!}
                    </div>

                    <div
                        class="mt-16 pt-8 border-t border-base-300 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="font-serif italic text-lg text-base-content/70">
                            Suka artikel ini? Bagikan ke yang lain.
                        </p>
                        <x-share-buttons :url="url()->current()" :title="$article->title" />
                    </div>
                </div>

                {{-- Sidebar — artikel lainnya, nempel pas scroll --}}
                @if ($related->isNotEmpty())
                    <aside class="lg:sticky lg:top-28">
                        <div class="rounded-2xl bg-neutral-950 px-6 py-5 mb-6">
                            <h2 class="font-serif text-lg font-semibold text-white">Artikel Lainnya</h2>
                        </div>

                        <div class="space-y-5">
                            @foreach ($related as $item)
                                <a href="{{ route('artikel.show', $item) }}" data-cursor-text="Baca"
                                    class="flex gap-4 group">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0 bg-base-300">
                                        <img src="{{ $item->cover_image ? asset('storage/' . $item->cover_image) : asset('images/craft.webp') }}"
                                            alt="{{ $item->title }}" class="w-full h-full object-cover" loading="lazy">
                                    </div>
                                    <div class="min-w-0">
                                        <h3
                                            class="font-serif text-sm font-semibold leading-snug line-clamp-2 group-hover:text-brand transition-colors">
                                            {{ $item->title }}
                                        </h3>
                                        <p class="font-sans text-xs text-base-content/40 mt-1.5">
                                            {{ $item->updated_at->locale('id')->translatedFormat('d M Y') }}
                                            @if ($item->category)
                                                &middot; {{ $item->category->name }}
                                            @endif
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    </main>

    @include('sections.footer')
</x-layout>
