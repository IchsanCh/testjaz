@props(['url', 'title'])

<div class="flex items-center gap-3" x-data="{ copied: false }">
    <span class="font-sans text-xs text-base-content/50 tracking-wide uppercase mr-1">Bagikan</span>

    {{-- WhatsApp --}}
    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($title . ' - ' . $url) }}" target="_blank" rel="noopener"
        aria-label="Bagikan ke WhatsApp"
        class="w-9 h-9 flex items-center justify-center rounded-full bg-base-200 hover:bg-primary hover:text-primary-content text-base-content/70 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path
                d="M12.04 2c-5.52 0-10 4.48-10 10 0 1.77.46 3.45 1.27 4.9L2 22l5.25-1.38A9.96 9.96 0 0012.04 22c5.52 0 10-4.48 10-10s-4.48-10-10-10zm0 18.2c-1.6 0-3.13-.43-4.46-1.24l-.32-.19-3.12.82.83-3.04-.2-.32a8.18 8.18 0 01-1.26-4.36c0-4.52 3.68-8.2 8.2-8.2s8.2 3.68 8.2 8.2-3.68 8.2-8.2 8.2zm4.5-6.13c-.25-.12-1.46-.72-1.69-.8-.23-.08-.39-.12-.56.12-.16.25-.64.8-.79.96-.14.16-.29.18-.54.06-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.38-1.72-.15-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.16.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43-.14-.01-.31-.01-.47-.01-.16 0-.43.06-.65.31-.23.25-.85.83-.85 2.03 0 1.2.87 2.35 1 2.51.12.16 1.71 2.61 4.14 3.66.58.25 1.03.4 1.38.51.58.18 1.11.16 1.53.1.47-.07 1.46-.6 1.66-1.17.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.28z" />
        </svg>
    </a>

    {{-- Facebook --}}
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($url) }}" target="_blank" rel="noopener"
        aria-label="Bagikan ke Facebook"
        class="w-9 h-9 flex items-center justify-center rounded-full bg-base-200 hover:bg-primary hover:text-primary-content text-base-content/70 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path
                d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0022 12z" />
        </svg>
    </a>

    {{-- X / Twitter --}}
    <a href="https://twitter.com/intent/tweet?url={{ rawurlencode($url) }}&text={{ rawurlencode($title) }}"
        target="_blank" rel="noopener" aria-label="Bagikan ke X"
        class="w-9 h-9 flex items-center justify-center rounded-full bg-base-200 hover:bg-primary hover:text-primary-content text-base-content/70 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path
                d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-6.9L4.7 22H1.6l8.1-9.3L1 2h7.1l4.9 6.3L18.9 2zm-1.2 18h1.9L7.4 4h-2l12.3 16z" />
        </svg>
    </a>

    {{-- Copy link --}}
    <button type="button"
        @click="navigator.clipboard.writeText('{{ $url }}'); copied = true; setTimeout(() => copied = false, 2000)"
        aria-label="Salin tautan"
        class="w-9 h-9 flex items-center justify-center rounded-full bg-base-200 hover:bg-primary hover:text-primary-content text-base-content/70 transition-colors relative">
        <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
            class="w-4 h-4">
            <path
                d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5z" />
            <path
                d="M7.414 15.414a2 2 0 01-2.828-2.828l3-3a2 2 0 012.828 0 1 1 0 001.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5z" />
        </svg>
        <svg x-show="copied" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
            class="w-4 h-4 text-success">
            <path fill-rule="evenodd"
                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                clip-rule="evenodd" />
        </svg>
    </button>
</div>
