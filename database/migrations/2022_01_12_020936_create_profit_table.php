<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po', 35);
            $table->string('nama_perusahaan', 100);
            $table->string('nomor_invoice', 3);
            $table->date('date');
            $table->integer('biaya_operasional');
            $table->integer('total_jual');
            $table->string('status');
            $table->integer('sum_profit');
            $table->integer('average_profit');
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
        Schema::dropIfExists('profit');
    }
}
