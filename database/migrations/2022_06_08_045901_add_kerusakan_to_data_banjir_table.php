<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKerusakanToDataBanjirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_banjirs', function (Blueprint $table) {
            $table->boolean('rumah')->nullable();
            $table->boolean('jalan')->nullable();
            $table->boolean('jembatan')->nullable();
            $table->boolean('perkantoran')->nullable();
            $table->boolean('tmpt_ibadah')->nullable();
            $table->boolean('sekolah')->nullable();
            $table->boolean('tanggul')->nullable();
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
