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
        Schema::create('order_details', function (Blueprint $col) {
            $col->id();
            $col->foreignId('order_id')->constrained('orders')->restrictOnDelete();
            $col->enum('metode', ['antar', 'ambil']);
            $col->enum('payment', ['qris', 'transfer', 'tunai']);    
            $col->enum('status', ['keranjang', 'pending', 'lunas']);
            $col->decimal('subtotal', 10,2);
            $col->decimal('ongkir', 10,2)->default(0);
            $col->decimal('total');
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
        Schema::dropIfExists('order_details');
    }
};
