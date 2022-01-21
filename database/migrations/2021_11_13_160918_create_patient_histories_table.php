<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->integer('was_positive')->nullable();
            $table->string('cured_place')->nullable();
            $table->string('injection_source')->nullable();
            $table->date('test_date')->nullable();
            $table->unsignedInteger('test_reason')->nullable();
            $table->unsignedInteger('test_place')->nullable();
            $table->unsignedInteger('test_result')->nullable();
            $table->date('result_date')->nullable();
            $table->string('symptoms')->nullable();
            $table->date('symptoms_date')->nullable();
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
        Schema::dropIfExists('patient_histories');
    }
}
