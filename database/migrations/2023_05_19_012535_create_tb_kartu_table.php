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
        Schema::create('tb_kartu', function (Blueprint $table) {
            $table->increments('no');
            $table->string('nik','20');
            $table->string('nama','50');
            $table->string('alamat','100');
            $table->string('tgl','20');
            $table->string('tempat','20');
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
        Schema::dropIfExists('tb_kartu');
    }
};
