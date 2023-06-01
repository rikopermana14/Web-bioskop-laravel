<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_booking', function (Blueprint $table) {
            $table->id();
            $table->string('id_film');
            $table->string('id_user');
            $table->string('kursi');
            $table->string('jam');
            $table->string('id_bioskop');
            $table->string('tanggal');
            $table->string('id_price');
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
        //
    }
};
