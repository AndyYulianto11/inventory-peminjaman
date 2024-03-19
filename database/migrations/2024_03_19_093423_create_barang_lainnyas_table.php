<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangLainnyasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_lainnyas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pengaju_id')->constrained('datapengajus');
            $table->string('code_barang');
            $table->string('nm_barang');
            $table->foreignId('jenis_id')->constrained('jenisbarang');
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
        Schema::dropIfExists('barang_lainnyas');
    }
}
