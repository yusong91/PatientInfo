<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Vanguard\Patient;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'health_facility_id' => rand(2,14),
            'form_date' => now(),
            'form_writer_name' => $this->faker->name(),
            'form_writer_phone' => Str::random(9),
            'test_reason' => rand(16,20),
            'direct_exposure' => rand(0,1),
            'exposure_name' => Str::random(10),
            'exposure_type' => 0,
            'name' => $this->faker->name(),
            'code' => strtoupper(Str::random(5)),
            'gender' => rand(36,37),
            'dob' => now(),
            'nation_id' => rand(36,100),
            'phone' => Str::random(9),
            'address' => Str::random(10),
            'address_code' => rand(01,20),
            'province' => rand(01,20),
//            'district' => $this->faker->district(),
//            'commune' => $this->faker->commune(),
//            'village' => $this->faker->village(),
//            'address_description' => $this->faker->address_description(),
//            'symptom_date' => $this->faker->symptom_date(),
//            'was_positive' => $this->faker->was_positive(),
//            'has_travel' => $this->faker->has_travel(),
            'travel_place' => Str::random(10),
            'travel_date' => now(),
            'travel_no' => rand(100,1000),
//            'travel_id' => $this->faker->travel_id(),
            'travel_chair' => rand(01,99),
//            'travel_description' => $this->faker->travel_description(),
            'laboratory_name' => Str::random(10),
            'laboratory_date' => now(),
//            'laboratory_id' => $this->faker->laboratory_id(),
//            'object_types_id' => $this->faker->object_types_id(),
//            'first_vaccine' => $this->faker->first_vaccine(),
//            'first_vaccine_date' => $this->faker->first_vaccine_date(),
//            'first_vaccine_type_id' => $this->faker->first_vaccine_type_id(),
//            'second_vaccine' => $this->faker->second_vaccine(),
//            'second_vaccine_date' => $this->faker->second_vaccine_date(),
//            'second_vaccine_type_id' => $this->faker->second_vaccine_type_id(),
//            'third_vaccine' => $this->faker->third_vaccine(),
//            'third_vaccine_date' => $this->faker->third_vaccine_date(),
//            'third_vaccine_type_id' => $this->faker->third_vaccine_type_id(),
            'laboratory_collector' => Str::random(10),
            'laboratory_collector_phone' => Str::random(10),
//            'laboratory_file' => $this->faker->laboratory_file(),
//            'qr_data' => $this->faker->qr_data(),
            'operator_data' => now(),
        ];
    }
}
