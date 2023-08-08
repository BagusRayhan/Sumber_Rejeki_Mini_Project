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
        Schema::create('fitur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('namafitur')->nullable();
            $table->string('hargafitur')->nullable();
            $table->string('biayatambahan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status',['belum selesai','selesai','revisi']);
            $table->enum('status2', ['revisi'])->nullable();
            $table->foreign('project_id')->references('id')->on('proreq')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fitur');
    }
};
