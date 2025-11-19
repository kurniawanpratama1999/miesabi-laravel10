<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /* 
        */
        Schema::create('orders', function (Blueprint $col) {
            $col->id();
            $col->foreignId('user_id')
            ->constrained('users')
            ->restrictOnDelete();
            $col->foreignId('delivery_id')->constrained('delivery_methods')->restrictOnDelete();
            $col->string('code')->unique();
            $col->enum('payment_with', ['qris', 'transfer', 'tunai']);    
            $col->enum('payment_status', ['keranjang', 'pending', 'lunas']);
            $col->enum('order_status', ['menunggu', 'proses', 'kirim', 'selesai']);
            $col->string('note')->default('-');
            $col->string('address');
            $col->string('phone');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
