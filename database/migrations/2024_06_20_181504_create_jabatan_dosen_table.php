<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatanDosenTable extends Migration
{
    public function up()
    {
        Schema::create('jabatan_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('fungsional');
            $table->string('struktural');
            $table->enum('status_pekerjaan', ['tetap', 'tidak tetap']);
            $table->enum('status_keaktifan', ['aktif', 'tidak aktif', 'tugas belajar']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jabatan_dosen');
    }
}
