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
        Schema::create('tb_medis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('berobat_id');
            $table->string('tgl','12');
            $table->string('umur','100');
            $table->string('dokter','50');
            $table->string('perawat','50');
            $table->string('sistolik','5');
            $table->string('diastolik','5');
            $table->string('saturasi','5');
            $table->string('suhu','5');
            $table->string('tinggi','5');
            $table->string('berat','5');
            $table->string('napas','5');
            $table->string('keluhan','100');
            $table->string('tindakan','25');
            $table->string('keterangan','100');
            $table->string('biaya','10');
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
        Schema::dropIfExists('tb_medis');
    }
};
