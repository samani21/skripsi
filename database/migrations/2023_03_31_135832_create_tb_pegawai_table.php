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
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip','30');
            $table->string('nama','50');
            $table->date('tanggal');
            $table->string('tempat','50');
            $table->string('alamat','100');
            $table->string('jns_kelamin','15');
            $table->string('kelompok','50');
            $table->string('spesialis','50');
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
        Schema::dropIfExists('tb_pegawai');
    }
};
