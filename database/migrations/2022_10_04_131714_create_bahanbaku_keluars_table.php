<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanbakuKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahanbaku_keluars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('bahanbakus_id')->nullable()->index();
            $table->foreign('bahanbakus_id')->references('id')->on('bahanbakus')->onDelete('cascade');
            $table->uuid('users_id')->nullable()->index();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('periodes_id')->nullable()->index();
            $table->foreign('periodes_id')->references('id')->on('periodes')->onDelete('cascade');
            $table->uuid('produksis_id')->nullable()->index();
            $table->foreign('produksis_id')->references('id')->on('produksis')->onDelete('cascade');
            $table->string('ukuran')->nullable();
            $table->integer('jumlah')->default(0);
            $table->string('satuan')->nullable();
            $table->date('tanggal_bbk');
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
        Schema::dropIfExists('bahanbaku_keluars');
    }
}
