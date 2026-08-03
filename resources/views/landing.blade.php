<?php $settings = \App\Models\SiteSetting::current(); ?>
<x-layout showEntrance="true">
    <x-navbar />

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
