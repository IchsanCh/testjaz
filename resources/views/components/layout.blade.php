@props([
    'title' => null,
    'description' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
    'showEntrance' => false,
])

@php
    $settings = \App\Models\SiteSetting::current();
    $pageTitle = $title ?? ($settings->default_meta_title ?? $settings->app_name);
    $pageDescription = $description ?? $settings->default_meta_description;
@endphp

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta property="og:title" content="{{ $ogTitle ?? $pageTitle }}">
    <meta property="og:description" content="{{ $ogDescription ?? $pageDescription }}">
    @if ($ogImage ?? $settings->default_og_image)
        <meta property="og:image" content="{{ asset('storage/' . ($ogImage ?? $settings->default_og_image)) }}">
    @endif
    <meta property="og:type" content="website">
    <meta name="robots" content="index, follow">

    @if ($settings->logo)
        <link rel="icon" href="{{ asset('storage/' . $settings->logo) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @endif

    {{-- Preload font kritis yang kepake di hero, biar gak nunggu request lain dulu --}}
    <link rel="preload" href="{{ asset('fonts/fraunces-v38-latin-600.woff2') }}" as="font" type="font/woff2"
        crossorigin>
    <link rel="preload" href="{{ asset('fonts/inter-v20-latin-regular.woff2') }}" as="font" type="font/woff2"
        crossorigin>

    {{-- Cegah "kedip" tema salah sebelum JS lain sempet jalan --}}
    <script>
        (function() {
            const saved = localStorage.getItem('theme');
            const theme = saved || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'alhijaz-dark' :
                'alhijaz-light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-base-100 text-base-content antialiased">

    {{ $slot }}

    {{-- Entrance overlay — cuma render kalau eksplisit diaktifin (Home doang) --}}
    @if ($showEntrance)
        <div id="entrance" class="entrance" aria-hidden="true">
            <div class="entrance__loom">
                @for ($i = 0; $i < 6; $i++)
                    <span class="entrance__warp" style="--i: {{ $i }}"></span>
                @endfor
                <span class="entrance__shuttle"></span>
            </div>
            <span class="entrance__title">AL HIJAZ</span>
            <span class="entrance__slogan">Sarung Tenun Premium</span>
        </div>
    @endif

    <div id="cursor-ring" class="cursor-ring" aria-hidden="true"></div>
    <div id="cursor-tooltip" class="cursor-tooltip" aria-hidden="true">
        <span id="cursor-tooltip-label"></span>
    </div>

    {{-- Toast notification — dipanggil lewat window.hijazNotify(type, title, message) --}}
    <div class="toast-stack" aria-live="polite">
        <template x-for="toast in $store.toasts.items" :key="toast.id">
            <div class="toast-card" :class="toast.type === 'error' ? 'toast-card--error' : 'toast-card--success'"
                x-show="toast.visible" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 translate-x-4"
                x-transition:enter-end="opacity-100 translate-y-0 translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 translate-x-4">
                <span class="toast-card__icon">
                    <svg x-show="toast.type !== 'error'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg x-show="toast.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10A8 8 0 11.001 10 8 8 0 0118 10zm-7-4a1 1 0 10-2 0v4a1 1 0 002 0V6zm-1 8a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="toast-card__body">
                    <p class="toast-card__title" x-text="toast.title"></p>
                    <p class="toast-card__message" x-text="toast.message"></p>
                </div>
                <button type="button" class="toast-card__close" @click="$store.toasts.remove(toast.id)"
                    aria-label="Tutup notifikasi">&times;</button>
            </div>
        </template>
    </div>
    {{-- Shortcut ketik "admin" buat lompat ke panel — sengaja gak ada tombol login tampil di publik --}}
    <script>
        (function() {
            let keys = [];
            const target = 'admin';
            document.addEventListener('keydown', function(e) {
                keys.push(e.key.toLowerCase());
                keys = keys.slice(-target.length);
                if (keys.join('') === target) {
                    window.location.href = '{{ url('/hijaz/admin') }}';
                }
            });
        })();
    </script>
</body>

</html>
