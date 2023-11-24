<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPengadaanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pengadaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->string('nama_transaksi');
            $table->date('tgl_transaksi');
            $table->foreignId('user_id');
            // 0 = diajukan, 1 = draft, 2 = disetujui, 3 = direvisi, 4 = ditolak, 5 = dipending
            $table->enum('status_transaksi', ['0', '1', '2', '3', '4', '5'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pengadaan_barangs');
    }
}
