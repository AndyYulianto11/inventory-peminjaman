<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangmasuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nota')->unique();
            $table->date('tanggal_pembelian');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->double('ppn_angka')->default(0)->nullable();
            $table->double('ppn_persen')->default(0)->nullable();
            $table->double('diskon_angka')->default(0)->nullable();
            $table->double('diskon_persen')->default(0)->nullable();
            $table->double('total_bayar')->default(0)->nullable();
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
        Schema::dropIfExists('barangmasuks');
    }
}
