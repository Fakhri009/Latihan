<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->string('nama_customer');
            $table->string('nic');
            $table->bigInteger('pelayanan_id')->unsigned();
            $table->string('telp');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->timestamps();

            // Relation tabels
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pelayanan_id')->references('id')->on('pelayanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
