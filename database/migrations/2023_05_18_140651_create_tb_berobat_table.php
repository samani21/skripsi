<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_berobat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pasien_id');
            $table->string('no_berobat','6');
            $table->string('nik','17');
            $table->string('jenis_berobat','10');
            $table->string('bpjs','17');
            $table->string('umum','10');
            $table->string('nama_berobat','50');
            $table->string('umur','100');
            $table->string('poli','15');
            $table->string('tgl','12');
            $table->string('bulan','3');
            $table->string('tahun','5');
            $table->string('status','2');
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
        Schema::dropIfExists('tb_berobat');
    }
};
