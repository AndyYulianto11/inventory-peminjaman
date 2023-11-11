<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDataPengajusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_data_pengajus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datapengaju_id');
            $table->foreignId('barang_id');
            $table->double('qty');
            // 0 = diajukan, 1 = disetujui, 2 = ditolak, 3 = direvisi
            $table->enum('status_persetujuanatasan', ['0', '1', '2', '3'])->default('0');
            // 0 = serah terima, 1 = Sebagian Diserahterimakan
            $table->boolean('status_persetujuanadmin')->nullable();
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
        Schema::dropIfExists('item_data_pengajus');
    }
}
