<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id',100)->nullable();
            $table->text('lost_reason')->nullable();
            $table->date('lost_date')->nullable();
            $table->string('creator',100)->nullable();
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
        Schema::dropIfExists('lost_assets');
    }
}
