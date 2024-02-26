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
            $table->string('code_pengajuan')->unique();
            $table->date('tgl_pengajuan');
            $table->foreignId('user_id')->constrained('users');
            // 1 = diajukan, 2 = diproses, 3 = disetujui, 4 = ditolak, 5 = direvisi
            $table->enum('status_setujuatasan', ['1', '2', '3', '4', '5'])->default('1');
            // 0 = diajukan, 1 = proses, 2 = pending, 3 = selesai
            $table->enum('status_setujuadmin', ['0', '1', '2', '3'])->default('0');
            $table->boolean('status_pengajuan')->default('0');
            $table->boolean('status_submit')->nullable();
            $table->string('upload_dokumen')->nullable();
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
