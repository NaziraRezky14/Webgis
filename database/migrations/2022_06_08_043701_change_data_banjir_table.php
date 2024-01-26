<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataBanjirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_banjirs', function (Blueprint $table) {
            $table->string('nama_pelapor');
            $table->string('nik');
            $table->longText('deskripsi');
            $table->string('ket');
            $table->string('ketinggian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_banjirs', function (Blueprint $table) {
            //
        });
    }
}
