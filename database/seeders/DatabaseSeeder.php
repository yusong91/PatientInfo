<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Vanguard\Patient;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Patient::factory()->times(100)->state([
            'created_at' => function () {
                return now()->subMinute(rand(0, 59));
            }
        ])->create();
//        $this->call(\Database\Seeders\CountriesSeeder::class);
//        $this->call(\Database\Seeders\RolesSeeder::class);
//        $this->call(\Database\Seeders\PermissionsSeeder::class);
//        $this->call(\Database\Seeders\UserSeeder::class);

        Model::reguard();
    }
}
