<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->string('name', length: 30)->unique();
            $table->string('image', length: 100);
            $table->integer('number_ports');
            $table->integer('places');
            $table->boolean('air_bag');
            $table->boolean('abs');
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_models', function(Blueprint $table) {
            $table->dropForeign('car_models_brand_id_foreign');
        });

        Schema::dropIfExists('car_models');
    }
};
