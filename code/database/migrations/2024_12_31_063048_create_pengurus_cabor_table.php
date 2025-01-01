<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusCaborTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus_cabor', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cabor');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('kota_lahir');
            $table->string('tanggal_lahir');
            $table->string('npwp');
            $table->string('foto');
            $table->enum('level', ['KETUA', 'WAKIL KETUA', 'SEKRETARIS','BENDAHARA','ANGGOTA'])->default('ANGGOTA');
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
        Schema::dropIfExists('pengurus_cabor');
    }
}
