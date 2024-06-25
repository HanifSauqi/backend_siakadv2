<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdPendidikanDosenFromDataDosenTable extends Migration
{
    public function up()
    {
        Schema::table('data_dosen', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['id_pendidikan_dosen']);
            // Then drop the column
            $table->dropColumn('id_pendidikan_dosen');
        });
    }

    public function down()
    {
        Schema::table('data_dosen', function (Blueprint $table) {
            // Add the column back
            $table->foreignId('id_pendidikan_dosen')->nullable()->constrained('pendidikan_dosen')->onDelete('cascade');
        });
    }
}
