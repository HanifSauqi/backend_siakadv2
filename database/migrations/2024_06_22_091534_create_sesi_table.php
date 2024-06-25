<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiTable extends Migration
{
    public function up()
    {
        Schema::create('sesi', function (Blueprint $table) {
            $table->id();
            $table->string('waktu');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sesi');
    }
}
