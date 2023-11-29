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
            $table->bigInteger('transaksipengadaanbarang_id');
            $table->foreignId('barang_id');
            $table->string('code_barang');
            $table->string('nama_barang');
            $table->string('satuan');
            $table->double('harga');
            $table->double('qty');
            $table->timestamps();

            $table->foreign('transaksipengadaanbarang_id')
                ->references('id')
                ->on('transaksi_pengadaan_barangs')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->name('fk_item_tpb_transaksipengadaanbarang');
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
