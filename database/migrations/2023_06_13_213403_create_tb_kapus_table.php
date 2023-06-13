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
        Schema::create('tb_kapus', function (Blueprint $table) {
            $table->id();
            $table->string('nip','50');
            $table->string('nama','50');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
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
        Schema::dropIfExists('tb_kapus');
    }
};
