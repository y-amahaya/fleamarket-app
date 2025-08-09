<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');     // users.id
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // products.id
            $table->timestamps();

            $table->unique(['user_id', 'product_id']); //  重複いいねを防止
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
