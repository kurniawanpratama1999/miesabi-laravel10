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
        Schema::create('orders', function (Blueprint $col) {
            $col->id();

            $col->foreignId('user_id')      // jika data user dihapus, maka akan gagal.
                ->constrained('users')       // selama masih ada order yang dimiliki
                ->restrictOnDelete();               // oleh user maka, data order tidak bisa dihapus

            $col->foreignId('product_id')   // jika data pada table product dihapus maka
                ->nullable()                        // data product id akan menjadi null
                ->constrained('products')    //
                ->nullOnDelete();                   //

            $col->foreignId('variant_id')   // jika data pada table variants dihapus maka
                ->nullable()                        // data variant id akan menjadi null
                ->constrained('variants')    //
                ->nullOnDelete();                   //

            $col->string('merge')->unique();

            $col->integer('quantity');
                
            $col->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
