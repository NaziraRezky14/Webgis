<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerdampaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terdampaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tematik_id')->constrained();
            $table->integer('rmh_terandam');
            $table->integer('t_kk');
            $table->integer('t_jiwa');
            $table->integer('m_mengungsi');
            $table->integer('m_jiwa');
            $table->integer('sakit');
            $table->integer('meninggal');
            $table->integer('hilang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terdampaks');
    }
}
