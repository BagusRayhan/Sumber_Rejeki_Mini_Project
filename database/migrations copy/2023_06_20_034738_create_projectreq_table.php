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
        Schema::create('projectreq', function (Blueprint $table) {
            $table->id();
            $table->string('namaclient');
            $table->string('namaproject');
            $table->string('dokumenpendukung');
            $table->dateTime('deadline');
            $table->string('status');
            $table->integer('harga');
            $table->string('alasan');
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
        Schema::dropIfExists('projectreq');
    }
};
