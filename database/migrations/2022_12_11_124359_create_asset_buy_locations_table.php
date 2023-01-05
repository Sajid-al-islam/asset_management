<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetBuyLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_buy_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('mobile_number', 255)->nullable();
            $table->string('creator',100)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('asset_buy_locations');
    }
}
