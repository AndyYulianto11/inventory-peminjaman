<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatapengajusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapengajus', function (Blueprint $table) {
            $table->id();
            $table->string('code_pengajuan');
            $table->date('tgl_pengajuan');
            $table->string('nama_barang');
            $table->foreignId('jenis_id');
            $table->integer('qty');
            $table->foreignId('satuan_id');
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
        Schema::dropIfExists('datapengajus');
    }
}
