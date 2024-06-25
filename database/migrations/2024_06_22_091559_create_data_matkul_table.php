<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMatkulTable extends Migration
{
    public function up()
    {
        Schema::create('data_matkul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('kode');
            $table->integer('sks');
            $table->string('semester');
            $table->foreignId('id_data_dosen')->constrained('data_dosen')->onDelete('cascade');
            $table->foreignId('id_jadwal_matkul')->constrained('jadwal_matkul')->onDelete('cascade');
            $table->enum('jenis', ['wajib', 'pilihan']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_matkul');
    }
}
