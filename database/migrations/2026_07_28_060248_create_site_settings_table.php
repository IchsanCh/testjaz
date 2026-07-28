<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('logo')->nullable();
            $table->string('whatsapp_number');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('default_meta_title')->nullable();
            $table->string('default_meta_description')->nullable();
            $table->string('default_og_image')->nullable();
            // konten fleksibel/lepasan, misal moto owner - ditambah di sini
            // dulu daripada bikin tabel terpisah, tinggal panggil variabelnya langsung
            $table->string('owner_name')->nullable();
            $table->text('owner_quote')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
