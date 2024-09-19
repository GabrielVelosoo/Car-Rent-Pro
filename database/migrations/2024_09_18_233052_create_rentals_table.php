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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('car_id');
            $table->dateTime('start_date_period');
            $table->dateTime('expected_end_date_period');
            $table->dateTime('actual_end_date_period');
            $table->float('daily_rate', 8,2);
            $table->integer('initial_km');
            $table->integer('final_km');
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign('rentals_client_id_foreign');
            $table->dropForeign('rentals_car_id_foreign');
        });

        Schema::dropIfExists('rentals');
    }
};
