<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidikanDosenTable extends Migration
{
    public function up()
    {
        Schema::create('pendidikan_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('jurusan');
            $table->foreignId('id_sarjana')->constrained('sarjana')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendidikan_dosen');
    }
}
