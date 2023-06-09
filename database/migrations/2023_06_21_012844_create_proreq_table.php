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
            $table->unsignedBigInteger('user_id');
            $table->string('nama')->nullable();
            $table->string('napro')->nullable();
            $table->string('progress')->nullable();
            $table->string('dokumen')->nullable();
            $table->dateTime('estimasi')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('status')->nullable();
            $table->integer('harga')->nullable();
            $table->string('alasan')->nullable();
            $table->string('statusbayar')->nullable();
            $table->string('biayatambahan')->nullable();
            $table->string('metodepembayaran')->nullable();
            $table->string('metode')->nullable();
            $table->string('buktipembayaran')->nullable();
            $table->dateTime('tanggalpembayaran')->nullable();
            $table->string('metodepembayaran2')->nullable();
            $table->string('metode2')->nullable();
            $table->string('buktipembayaran2')->nullable();
            $table->dateTime('tanggalpembayaran2')->nullable();
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
