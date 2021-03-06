<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_line', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('product_available_id');
            //$table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->index('reservation_id');
            $table->index('product_available_id');
            $table->primary(['reservation_id','product_available_id']);
            //$table->index('product_id');

            $table->foreign('reservation_id')->on('reservations')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_lines');
    }
};
