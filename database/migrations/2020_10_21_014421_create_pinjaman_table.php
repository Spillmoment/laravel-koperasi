<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');

            $table->integer('nominal');
            $table->float('bagi_hasil');
            $table->char('jangka_waktu', 2);
            $table->integer('bayar_pokok');
            $table->integer('hasil_bagi');
            $table->integer('bayar_perbulan');
            $table->integer('total');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'belum_lunas', 'lunas']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
}
