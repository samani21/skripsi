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
        Schema::create('tb_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pasien_id');
            $table->integer('berobat_id');
            $table->integer('medis_id');
            $table->string('tgl1','15');
            $table->string('tgl2','15');
            $table->string('status','3');
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
        Schema::dropIfExists('tb_surat');
    }
};
