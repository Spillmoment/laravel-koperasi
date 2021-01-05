<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayarPinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayar_pinjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pinjaman_id');
            $table->foreign('pinjaman_id')->references('id')->on('pinjaman')->onDelete('cascade');

            $table->date('jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->integer('nominal')->nullable();
            $table->integer('denda')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('bayar_pinjamen');
    }
}
