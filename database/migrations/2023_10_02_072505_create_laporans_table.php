

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kapster_id')->unsigned();
            $table->string('jumlah_potong');
            $table->bigInteger('produk_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
           // $table->bigInteger('pelayanan_id')->unsigned();
            $table->timestamps();
            
            // Define foreign key constraints
            $table->foreign('kapster_id')->references('id')->on('kapsters')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('laporans');
    }
}