<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTransaksiPengadaanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_transaksi_pengadaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadaan_barang_id')->constrained('transaksi_pengadaan_barangs');
            $table->foreignId('barang_id')->constrained('databarangs');
            $table->string('code_barang');
            $table->string('nama_barang');
            $table->string('satuan');
            $table->double('harga');
            $table->double('qty');
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
        Schema::dropIfExists('item_transaksi_pengadaan_barangs');
    }
}
