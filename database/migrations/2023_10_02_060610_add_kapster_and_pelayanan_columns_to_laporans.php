<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKapsterIdToLaporansTable extends Migration
{
    public function up()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->unsignedBigInteger('kapster_id')->nullable();
            $table->foreign('kapster_id')->references('id')->on('kapsters');
        });
    }

    public function down()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign(['kapster_id']);
            $table->dropColumn('kapster_id');
        });
    }
}
