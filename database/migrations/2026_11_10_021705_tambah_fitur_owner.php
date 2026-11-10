<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('is_langganan')->default(false)->after('role');
    });

    Schema::table('products', function (Blueprint $table) {
        $table->unsignedInteger('price_langganan')->default(0)->after('price');
    });
    // barang yang sudah ada: harga langganan sementara disamakan dengan harga umum
    DB::table('products')->update(['price_langganan' => DB::raw('price')]);

    Schema::table('orders', function (Blueprint $table) {
        $table->string('wilayah', 20)->default('dalam_kota')->after('alamat');
    });
}

public function down(): void
{
    Schema::table('users', fn (Blueprint $t) => $t->dropColumn('is_langganan'));
    Schema::table('products', fn (Blueprint $t) => $t->dropColumn('price_langganan'));
    Schema::table('orders', fn (Blueprint $t) => $t->dropColumn('wilayah'));
}
};
