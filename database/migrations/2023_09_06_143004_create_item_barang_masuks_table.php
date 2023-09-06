<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangmasuk_id');
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('barang_id');
            $table->integer('qty');
            $table->integer('harga');
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
        Schema::dropIfExists('item_barang_masuks');
    }
}
