<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cabor');
            $table->string('nama_kejuaraan');
            $table->string('tingkat_kejuaraan');
            $table->datetime('waktu_kegiatan');
            $table->string('perolehan_medali');
            $table->string('foto_kegiatan');
            $table->string('scan_piagam');
            $table->string('scan_hasil_pertandingan');
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
        Schema::dropIfExists('prestasi');
    }
}
