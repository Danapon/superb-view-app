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
        Schema::table('superb_view_reviews', function (Blueprint $table) {
            $table->bigInteger('superb_view_master_id')->unsigned();
            $table->foreign('superb_view_master_id')->references('id')->on('superb_view_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('superb_view_reviews', function (Blueprint $table) {
            $table->dropColumn('superb_view_master_id');
        });
    }
};
