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
            Schema::create('proreq', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('napro')->nullable();
            $table->string('progress')->nullable();
            $table->string('bukti')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('status')->nullable();
            $table->integer('harga')->nullable();
            $table->string('alasan')->nullable();
            $table->string('statusbayar')->nullable();

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
        Schema::dropIfExists('proreq');
    }
};
