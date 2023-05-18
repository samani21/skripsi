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
        Schema::create('tb_resep', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('berobat_id');
            $table->integer('kd_obat');
            $table->string('jumlah','10');
            $table->string('dosis','100');
            $table->string('pakai','50');
            $table->string('tgl','12');
            $table->string('bulan','3');
            $table->string('tahun','6');
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
        Schema::dropIfExists('tb_resep');
    }
};
