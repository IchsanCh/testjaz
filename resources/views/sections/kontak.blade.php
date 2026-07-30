{{--
    Section: Kontak
    Belum ke-connect ke DB — form submit-nya nanti diarahin ke route POST /kontak,
    disimpen ke ContactSubmission
--}}
<section class="py-24 md:py-32 bg-base-300 text-base-content" id="kontak">
    <div class="max-w-7xl mx-auto px-6 md:px-16 grid md:grid-cols-2 gap-16 items-start">

        {{-- Teks + info kontak --}}
        <div class="reveal">
            <div class="flex items-center gap-3 mb-6">
                <span class="h-px w-10 bg-primary"></span>
                <span class="text-primary font-sans text-xs md:text-sm tracking-[0.3em] uppercase">
                    Kontak
                </span>
            </div>
            <h2 class="font-serif text-3xl md:text-5xl font-semibold leading-tight mb-6">
                <span class="reveal-line"><span>Mari Bicara Soal</span></span>
                <span class="reveal-line"><span>Sarung Anda Berikutnya</span></span>
            </h2>
            <p class="text-base-content/60 font-sans text-base md:text-lg leading-relaxed mb-10 max-w-md">
                Ada pertanyaan soal motif, ukuran, atau pemesanan dalam jumlah besar?
                Tim kami siap bantu.
            </p>

            <div class="space-y-4 font-sans text-sm md:text-base">
                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                    class="flex items-center gap-3 text-base-content/80 hover:text-primary transition-colors">
                    <span class="text-base-content/40">WhatsApp</span>
                    <span>+62 812-3456-7890</span>
                </a>
                <div class="flex items-center gap-3 text-base-content/80">
                    <span class="text-base-content/40">Email</span>
                    <span>info@alhijaz.test</span>
                </div>
                <div class="flex items-center gap-3 text-base-content/80">
                    <span class="text-base-content/40">Lokasi</span>
                    <span>Pekalongan, Jawa Tengah</span>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ url('/kontak') }}"
            class="bg-base-100 rounded-2xl p-6 md:p-8 space-y-5 reveal reveal-delay-1">
            @csrf

            <div>
                <label for="name" class="block font-sans text-sm text-base-content/60 mb-2">Nama</label>
                <input type="text" name="name" id="name" required
                    class="w-full bg-base-200 border border-base-300 rounded-lg px-4 py-3 text-base-content placeholder:text-base-content/30 focus:outline-none focus:border-primary transition-colors"
                    placeholder="Nama lengkap">
            </div>

            <div>
                <label for="whatsapp_number" class="block font-sans text-sm text-base-content/60 mb-2">Nomor
                    WhatsApp</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" required
                    class="w-full bg-base-200 border border-base-300 rounded-lg px-4 py-3 text-base-content placeholder:text-base-content/30 focus:outline-none focus:border-primary transition-colors"
                    placeholder="08xx-xxxx-xxxx">
            </div>

            <div>
                <label for="message" class="block font-sans text-sm text-base-content/60 mb-2">Pesan</label>
                <textarea name="message" id="message" rows="4" required
                    class="w-full bg-base-200 border border-base-300 rounded-lg px-4 py-3 text-base-content placeholder:text-base-content/30 focus:outline-none focus:border-primary transition-colors resize-none"
                    placeholder="Tulis pertanyaan atau pesan Anda"></textarea>
            </div>

            <button type="submit"
                class="w-full bg-primary text-primary-content font-sans font-semibold py-3.5 rounded-lg transition-all hover:brightness-110">
                Kirim Pesan
            </button>
        </form>

    </div>
</section>
