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
            $table->char('jangka_waktu', 2);
            $table->char('bagi_hasil', 3);
            $table->integer('bayar_perbulan');
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
