<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryStokBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_stok_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('databarang_id')->nullable();
            $table->foreignId('barangmasuk_id')->nullable();
            $table->foreignId('itemdatapengaju_id')->nullable();
            $table->integer('qty')->default(0)->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('history_stok_barangs');
    }
}
