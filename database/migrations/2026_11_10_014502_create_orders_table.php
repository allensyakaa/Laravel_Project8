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
       Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('product_id')->constrained()->restrictOnDelete();
        $table->unsignedInteger('jumlah');
        $table->unsignedBigInteger('total_harga');
        $table->text('alamat');
        $table->string('metode_pembayaran', 30);      // transfer_bank / e_wallet / cod
        $table->string('bukti_pembayaran')->nullable();
        $table->string('status', 20)->default('dalam_pesanan');
        $table->timestamps();
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
