<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // users.id
            $table->string('postal_code', 10);
            $table->string('prefecture', 50);
            $table->string('city', 100);
            $table->string('address_line', 255);
            $table->string('building', 255)->nullable(); // 建物名は任意と想定
            $table->string('phone_number', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};