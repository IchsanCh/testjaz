{{--
    Ikon "hexagon H" — badge emas dengan huruf H gelap di tengah.
    Warnanya sengaja fixed (bukan ngikut tema light/dark) karena emas di atas
    charcoal gelap tetap kebaca jelas di semua kondisi navbar: transparan di atas
    Hero, solid krem (tema terang), maupun solid gelap (tema gelap).
--}}
@props(['class' => 'w-9 h-9'])

<svg viewBox="0 0 100 100" class="{{ $class }}" role="img" aria-label="Logo AL HIJAZ">
    <polygon points="33,5 67,5 95,50 67,95 33,95 5,50" fill="#C9985A" />
    <text x="50" y="52" text-anchor="middle" dominant-baseline="central" font-family="'Inter', ui-sans-serif, sans-serif"
        font-weight="800" font-size="48" fill="#241B18" letter-spacing="-1">H</text>
</svg>
