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
        Schema::create('tb_biaya', function (Blueprint $table) {
            $table->id();
            $table->integer('pasien_id');
            $table->string('poli','50');
            $table->string('j_berobat','12');
            $table->string('biaya','50');
            $table->string('status','20');
            $table->string('tgl','20');
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
        Schema::dropIfExists('tb_biaya');
    }
};
