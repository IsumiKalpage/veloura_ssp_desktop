<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // 'skincare', 'haircare', 'cosmetics'
            $table->string('category', 20);
            $table->decimal('price', 10, 2);
            // numeric stock; we'll derive stock-status in views
            $table->unsignedInteger('stock')->default(0);
            // 'active' or 'draft'
            $table->string('status', 16)->default('active');
            $table->string('image_path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
