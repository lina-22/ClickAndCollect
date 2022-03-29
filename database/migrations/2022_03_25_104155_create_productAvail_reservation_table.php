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
        Schema::create('productAvail_reservation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productAvailable_id');
            // quantity antay hoba??        
            $table->unsignedBigInteger('reservation_id');
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
        Schema::dropIfExists('product_reservation');
    }
};
