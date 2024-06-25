<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalMatkulTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_matkul', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->foreignId('id_sesi')->constrained('sesi')->onDelete('cascade');
            $table->string('ruang');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_matkul');
    }
}
