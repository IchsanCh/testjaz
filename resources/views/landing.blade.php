<x-layout>
    <nav x-data="{
        scrolled: false,
        mobileOpen: false,
        isDark: document.documentElement.getAttribute('data-theme') === 'alhijaz-dark',
    }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 60);
    window.addEventListener('theme-changed', (e) => isDark = e.detail.theme === 'alhijaz-dark');"
        :class="scrolled ? 'bg-base-100/95 backdrop-blur-sm border-b border-base-300 py-4' : 'bg-transparent py-6'"
        class="fixed top-0 left-0 right-0 z-40 px-6 md:px-16 transition-all duration-300">
        <div class="flex items-center justify-between">
            <span :class="scrolled ? 'text-base-content' : 'text-white'"
                class="flex items-center gap-2.5 font-serif text-xl md:text-2xl font-semibold transition-colors duration-300">
                <x-logo-mark class="w-8 h-8 md:w-9 md:h-9" />
                AL HIJAZ
            </span>

            {{-- Desktop nav --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#tentang"
                    :class="scrolled ? 'text-base-content/70 hover:text-brand' : 'text-white/80 hover:text-white'"
                    class="text-sm font-sans transition-colors duration-300">Tentang</a>
                <a href="#katalog"
                    :class="scrolled ? 'text-base-content/70 hover:text-brand' : 'text-white/80 hover:text-white'"
                    class="text-sm font-sans transition-colors duration-300">Produk</a>
                <a href="#artikel"
                    :class="scrolled ? 'text-base-content/70 hover:text-brand' : 'text-white/80 hover:text-white'"
                    class="text-sm font-sans transition-colors duration-300">Artikel</a>
                <a href="#kontak"
                    :class="scrolled ? 'text-base-content/70 hover:text-brand' : 'text-white/80 hover:text-white'"
                    class="text-sm font-sans transition-colors duration-300">Kontak</a>

                <button type="button" onclick="toggleTheme()"
                    :class="scrolled ? 'text-base-content/70 hover:text-brand' : 'text-white/80 hover:text-white'"
                    :data-cursor-text="isDark ? 'Mode Terang' : 'Mode Gelap'" class="transition-colors duration-300"
                    aria-label="Ganti tema terang/gelap">
                    <svg x-show="!isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                    </svg>
                    <svg x-show="isDark" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            {{-- Mobile hamburger --}}
            <button type="button" @click="mobileOpen = !mobileOpen"
                :class="scrolled ? 'text-base-content' : 'text-white'" :data-cursor-text="mobileOpen ? 'Tutup' : 'Menu'"
                class="md:hidden transition-colors duration-300" aria-label="Buka menu">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        {{-- Mobile menu panel --}}
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden mt-4 pb-4 flex flex-col gap-4 bg-base-100 rounded-xl px-6 py-6 shadow-lg"
            style="display: none;">
            <a href="#tentang" @click="mobileOpen = false" class="text-base-content font-sans text-sm">Tentang</a>
            <a href="#katalog" @click="mobileOpen = false" class="text-base-content font-sans text-sm">Produk</a>
            <a href="#artikel" @click="mobileOpen = false" class="text-base-content font-sans text-sm">Artikel</a>
            <a href="#kontak" @click="mobileOpen = false" class="text-base-content font-sans text-sm">Kontak</a>
            <button type="button" onclick="toggleTheme()" class="text-left text-base-content font-sans text-sm">Ganti
                Tema</button>
        </div>
    </nav>

    <main>
        @include('sections.hero')
        @include('sections.tentang')
        @include('sections.proses')
        @include('sections.katalog')
        @include('sections.kenapa-pilih')
        @include('sections.artikel')
        @include('sections.kontak')
    </main>

    @include('sections.footer')
</x-layout>
