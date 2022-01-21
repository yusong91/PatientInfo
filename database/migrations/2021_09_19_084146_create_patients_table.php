<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer("health_facility_id")->nullable();
            $table->date("form_date")->nullable();
            $table->string("form_writer_name")->nullable();
            $table->string("form_writer_phone")->nullable();
            $table->integer("test_reason")->nullable();
            $table->boolean("direct_exposure")->nullable();
            $table->string("exposure_name")->nullable();
            $table->integer("exposure_type")->nullable();
            $table->string("name")->nullable();
            $table->string("code")->nullable();
            $table->string("gender")->nullable();
            $table->date("dob")->nullable();
            $table->integer("nation_id")->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("address_code")->nullable();
            $table->string("province")->nullable();
            $table->string("district")->nullable();
            $table->string("commune")->nullable();
            $table->string("village")->nullable();
            $table->string("address_description")->nullable();
            $table->date("symptom_date")->nullable();
            $table->boolean("was_positive")->nullable();
            $table->boolean("has_travel")->nullable();
            $table->string("travel_place")->nullable();
            $table->date("travel_date")->nullable();
            $table->string("travel_no")->nullable();
            $table->string("travel_id")->nullable();
            $table->string("travel_chair")->nullable();
            $table->text("travel_description")->nullable();
            $table->text("laboratory_name")->nullable();
            $table->date("laboratory_date")->nullable();
            $table->integer("laboratory_id")->nullable();
            $table->integer("object_types_id")->nullable();
            $table->boolean("first_vaccine")->nullable();
            $table->date("first_vaccine_date")->nullable();
            $table->integer("first_vaccine_type_id")->nullable();
            $table->boolean("second_vaccine")->nullable();
            $table->date("second_vaccine_date")->nullable();
            $table->integer("second_vaccine_type_id")->nullable();
            $table->boolean("third_vaccine")->nullable();
            $table->date("third_vaccine_date")->nullable();
            $table->integer("third_vaccine_type_id")->nullable();
            $table->string("laboratory_collector")->nullable();
            $table->string("laboratory_collector_phone")->nullable();
            $table->string("laboratory_file")->nullable();
            $table->text("qr_data")->nullable();
            $table->text("operator_data")->nullable();
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
        Schema::dropIfExists('patients');
    }
}
