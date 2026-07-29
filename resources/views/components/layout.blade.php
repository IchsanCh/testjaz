@props([
    'title' => null,
    'description' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
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

    <div id="cursor-dot" class="cursor-dot" aria-hidden="true"></div>

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
