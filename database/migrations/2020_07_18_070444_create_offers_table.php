<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('desc_ar')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('type')->nullable();
            $table->string('price')->nullable();
            $table->string('presentage')->nullable();
            $table->string('img')->nullable();
            $table->string('back_img')->nullable();

            $table->enum('active',['0','1'])->nullable();
            
            $table->string('link')->nullable();

            $table->unsignedBigInteger('country_id')->nullable();	
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
          
            $table->unsignedBigInteger('city_id')->nullable();	
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
           
            $table->unsignedBigInteger('category_id')->nullable();	
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('offers');
    }
}
