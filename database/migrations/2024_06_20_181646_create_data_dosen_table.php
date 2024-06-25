<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDosenTable extends Migration
{
    public function up()
    {
        Schema::create('data_dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('nidn')->unique();
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('no_telepon');
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->text('alamat');
            $table->foreignId('id_pendidikan_dosen')->constrained('pendidikan_dosen')->onDelete('cascade');
            $table->foreignId('id_jabatan_dosen')->constrained('jabatan_dosen')->onDelete('cascade');
            $table->foreignId('id_minat_penelitian')->constrained('minat_penelitian')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_dosen');
    }
}
