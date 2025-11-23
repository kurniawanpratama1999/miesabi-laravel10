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
            $col->tinyInteger('payment_with'); // 0 untuk tunai || 1 untuk qris || 2 untuk transfer    
            $col->tinyInteger('payment_status')->default(0); // 0 belum lunas || 1 untuk lunas
            $col->tinyInteger('order_status')->default(0); // 0 menunggu || 1 diproses || 2 Kirim || 3 Selesai
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
