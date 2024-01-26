<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnInDatabanjirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_banjirs', function (Blueprint $table) {
            $table->dropColumn('rumah');
            $table->dropColumn('jalan');
            $table->dropColumn('jembatan');
            $table->dropColumn('perkantoran');
            $table->dropColumn('tmpt_ibadah');
            $table->dropColumn('sekolah');
            $table->dropColumn('tanggul');
            $table->string('kerusakan')->nullable();
            $table->integer('hari');
            $table->integer('jam');
            $table->integer('menit');

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
