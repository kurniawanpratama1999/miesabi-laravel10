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
            $col->enum('payment_with', [1, 2, 3]); // 1 untuk tunai || 2 untuk qris || 3 untuk transfer
            $col->enum('payment_status', [1, 2, 3])->default(1); // 1 belum bayar || 2 customer sudah bayar || 3 admin konfirmasi
            $col->enum('order_status', [1, 2, 3, 4, 5, 6, 7])->default(1);
            $col->string('note')->default('-');
            $col->string('address');
            $col->string('phone');
            $col->string('orders_receipt')->default(null)->nullable();
            $col->string('comment')->default(null)->nullable();
            $col->enum('stars', [0, 1, 2, 3, 4, 5])->default(0);

            // $col->commentar
            // $col->stars
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
