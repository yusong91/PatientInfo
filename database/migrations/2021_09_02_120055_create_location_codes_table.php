<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_codes', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('province_code',255);
            $table->string('distict_code',255);
            $table->string('communce_code',255);
            $table->string('village_code',255);
            $table->string('code',255);
            $table->string('type',255);
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
        Schema::dropIfExists('location_codes');
    }
}
