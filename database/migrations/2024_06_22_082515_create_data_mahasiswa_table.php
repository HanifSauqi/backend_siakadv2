<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('data_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->string('alamat');
            $table->string('nim')->unique();
            $table->string('semester');
            $table->integer('sks')->default(54);
            $table->string('angkatan');
            $table->foreignId('id_fakultas')->constrained('fakultas')->onDelete('cascade');
            $table->foreignId('id_prodi')->constrained('prodi')->onDelete('cascade');
            $table->enum('status', ['aktif', 'tidak aktif']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_mahasiswa');
    }
}
