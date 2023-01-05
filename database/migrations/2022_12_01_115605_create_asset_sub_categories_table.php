<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_id',100)->nullable();
            $table->text('name')->nullable();
            $table->string('slug',100)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('asset_sub_categories');
    }
}
