<x-layout>
    <nav class="navbar bg-base-100 border-b border-base-300 px-6">
        <div class="flex-1">
            <span class="font-serif text-xl font-semibold">AL HIJAZ</span>
        </div>
        <div class="flex-none">
            <button type="button" onclick="toggleTheme()" class="btn btn-ghost btn-sm"
                aria-label="Ganti tema terang/gelap">
                Toggle Tema
            </button>
        </div>
    </nav>

    <main class="min-h-screen">
        {{-- Section-section landing page bakal ditaro di sini satu-satu:
             <x-sections.hero />, <x-sections.tentang />, dst --}}
        <section class="flex flex-col items-center justify-center text-center px-6 py-24">
            <h1 class="font-serif text-4xl md:text-5xl font-semibold mb-4">
                Sarung Tenun Turun Temurun
            </h1>
            <p class="text-base-content/70 max-w-xl">
                Layout dasar udah jalan, font Fraunces &amp; Inter, tema maroon-emas, dark/light mode,
                custom cursor, dan selection color semua udah aktif. Section aslinya nyusul.
            </p>
        </section>
    </main>
</x-layout>
