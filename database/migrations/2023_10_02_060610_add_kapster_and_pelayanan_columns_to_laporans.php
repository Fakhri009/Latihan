<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKapsterAndPelayananColumnsToLaporans extends Migration
{
    public function up()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->bigInteger('pelayanan_id')->unsigned();

         //Define foreign key constraints if needed
         $table->foreign('pelayanan_id')->references('id')->on('pelayanans')->onDelete('cascade');
    });
}


    public function down()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('kapster_id');
            $table->dropColumn('pelayanan_id');
        });
    }
}