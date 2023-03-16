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
        Schema::create('superb_view_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prefecture_master_id')->unsigned();
            $table->foreign('prefecture_master_id')->references('id')->on('prefecture_masters');
            $table->text('name')->comment('地名');
            $table->text('address')->comment('所在地');
            $table->double('lat',8,6)->comment('緯度');
            $table->double('lng',9,6)->comment('経度');
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
        Schema::dropIfExists('superb_view_masters');
    }
};
