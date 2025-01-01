<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatih', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cabor');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('kota_lahir');
            $table->string('tanggal_lahir');
            $table->string('npwp');
            $table->string('foto');
            $table->string('sertifikat');
            $table->string('ktp');
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
        Schema::dropIfExists('pelatih');
    }
}
