<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // users.id
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // categories.id
            $table->string('name');
            $table->string('brand');
            $table->text('description');
            $table->string('condition');
            $table->integer('price');
            $table->string('image_path');
            $table->boolean('is_sold')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
