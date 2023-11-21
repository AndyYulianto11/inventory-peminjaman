<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDataPengadaanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_data_pengadaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datapengadaanbarang_id');
            $table->foreignId('barang_id');
            $table->double('qty');
            // null = default, 1 = baik, 2 = baru, 3 = bekas
            $table->enum('kondisi_barang', ['1', '2', '3'])->nullable();
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
        Schema::dropIfExists('item_data_pengadaan_barangs');
    }
}
