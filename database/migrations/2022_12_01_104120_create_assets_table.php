<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name',500)->nullable();
            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->integer('is_lost')->nullable();
            $table->text('description')->nullable();
            $table->double('price')->nullable();
            $table->string('v_no')->nullable();
            $table->string('sv_no')->nullable();
            $table->string('code')->nullable();

            $table->string('location')->nullable();
            $table->string('buy_location_id')->nullable();
            $table->bigInteger('cs_quotation_id')->nullable();
            
            $table->string('depreciation_amount')->nullable();
            
            $table->text('image')->nullable();
            $table->text('asset_voucher_img')->nullable();
            $table->text('acceptance_img')->nullable();

            $table->string('designation_id')->nullable();
            $table->string('designation_mobile_number')->nullable();

            $table->string('is_warrenty')->nullable();
            $table->timestamp('warrenty_date')->nullable();
            $table->timestamp('buying_date')->nullable();
            $table->timestamp('hand_over_date')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('assets');
    }
}
