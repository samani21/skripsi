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
        Schema::create('tb_pasien', function (Blueprint $table) {
            $table->increments('id_pasien');
            $table->string('no_berobat','6');
            $table->string('nik','20');
            $table->string('jenis_berobat','10');
            $table->string('no_bpjs','20');
            $table->string('nama','50');
            $table->date('tanggal');
            $table->string('jk','15');
            $table->string('tempat','20');
            $table->string('alamat','100');
            $table->string('gol_darah','5');
            $table->string('no_hp','15');
            $table->string('tgl_pasien','11');
            $table->string('bulan_pasien','3');
            $table->string('tahun_pasien','5');
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
        Schema::dropIfExists('tb_pasien');
    }

    
};
