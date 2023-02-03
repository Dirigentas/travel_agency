<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
Use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Aras',
            'email' => 'admin.@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'administratorius'
        ]);

        foreach (range(0, 10) as $value) {
        DB::table('countries')->insert([
                'name' => $faker->countryCode ,
                'season_start' => $faker->dateTimeBetween('-4 week', '+4 week'),
                'season_end' => $faker->dateTimeBetween('+5 week', '+40 week'),
            ]);
        }
    }
}