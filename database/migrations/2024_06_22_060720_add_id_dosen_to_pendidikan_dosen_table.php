<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDosenToPendidikanDosenTable extends Migration
{
    public function up()
    {
        Schema::table('pendidikan_dosen', function (Blueprint $table) {
            $table->foreignId('id_dosen')->constrained('data_dosen')->onDelete('cascade')->after('id');
        });
    }

    public function down()
    {
        Schema::table('pendidikan_dosen', function (Blueprint $table) {
            $table->dropForeign(['id_dosen']);
            $table->dropColumn('id_dosen');
        });
    }
}
