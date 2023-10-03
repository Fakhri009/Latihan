<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('pcs');
            $table->string('foto');
            $table->string('harga');
            $table->timestamps();
            // Foreign keys
           // $table->foreign('laporan_id')->references('id')->on('laporans')->onDelete('cascade');
           // $table->foreign('pelayanan_id')->references('id')->on('pelayanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
