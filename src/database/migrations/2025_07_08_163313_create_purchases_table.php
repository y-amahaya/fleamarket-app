<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');     // users.id
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // products.id
            $table->foreignId('address_id')->constrained()->onDelete('cascade');  // addresses.id
            $table->string('payment_method', 50);
            $table->string('status', 50);
            $table->timestamp('purchased_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
