<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('bidID');
            $table->bigInteger('clientID');
            $table->bigInteger('workshopID');
            $table->bigInteger('serviceID');
            $table->bigInteger('employeeID');
            $table->bigInteger('carID')->nullable();
            $table->timestamp('datetime');
            $table->integer('duration')->nullable();
            $table->string('type');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('bids');
    }
}
