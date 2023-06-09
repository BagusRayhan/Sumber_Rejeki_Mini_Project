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
        Schema::create('project_disetujui', function (Blueprint $table) {
            $table->id();
            $table->string('namaclient');
            $table->string('namaproject');
            $table->string('progressproject');
            $table->string('hargaproject');
            $table->string('dokumenpendukung');
            $table->string('deadline');
            $table->string('estimasi');
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
        Schema::dropIfExists('project_disetujui');
    }
};
