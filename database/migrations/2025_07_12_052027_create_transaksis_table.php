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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_transaksi');
            $table->foreignId('harga_id')->nullable()->constrained('hargas')->nullOnDelete();
            $table->decimal('berat', 8, 2);
            $table->string('foto_sampah')->nullable();
            $table->text('alamat');
            $table->dateTime('waktu_penjemputan');
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->string('pembayaran')->default('Belum Dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
