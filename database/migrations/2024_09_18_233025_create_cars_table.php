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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_model_id');
            $table->string('car_plate', 10)->unique();
            $table->boolean('available');
            $table->integer('km');
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('car_model_id')->references('id')->on('car_models');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('cars_car_model_id_foreign');
        });

        Schema::dropIfExists('cars');
    }
};
