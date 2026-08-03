<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('name');
            $table->string('material')->nullable(); // contoh: "TR + TR"
            $table->unsignedInteger('size_width')->nullable(); // cm
            $table->unsignedInteger('size_length')->nullable(); // cm
            $table->string('edition')->nullable(); // contoh: "Premium", "Limited" — null = gak nampilin badge apa-apa
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
