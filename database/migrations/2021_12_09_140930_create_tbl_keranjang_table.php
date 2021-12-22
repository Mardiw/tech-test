<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_keranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_produk')->nullable();
            $table->foreign('id_user')->references('id')->on('tbl_user')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('id_produk')->references('id')->on('tbl_produk')->onUpdate('CASCADE')->onDelete('set null');
            $table->integer('qty');
            $table->enum('status_checkout', ['Tidak', 'Ya'])->default('Tidak');
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
        Schema::dropIfExists('tbl_keranjang');
    }
}
