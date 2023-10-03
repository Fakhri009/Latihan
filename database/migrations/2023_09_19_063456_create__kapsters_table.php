<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKapstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kapsters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable(); // Nullable user_id
            $table->string('nama_kapster');
            $table->string('nik');
            $table->string('telp');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->bigInteger('laporan_id')->unsigned();
            $table->timestamps();
            
            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('laporan_id')->references('id')->on('laporans')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kapsters');
    }
}
