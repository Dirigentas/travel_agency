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
            'role' => 'administrator'
        ]);
        DB::table('users')->insert([
            'name' => 'Marius',
            'email' => 'a@a',
            'password' => Hash::make('123'),
            'role' => 'user'
        ]);

        $countries = ['Airija', 'Kanada', 'Lietuva', 'JAV', 'Anglija', 'Graikija', 'Italija', 'Ispanija', 'Vokietija', 'Australija', 'Japonija'];

        foreach ($countries as $key => $value) {
        DB::table('countries')->insert([
                'name' => $countries[$key],
                'season_start' => $faker->dateTimeBetween('-4 week', '+4 week'),
                'season_end' => $faker->dateTimeBetween('+5 week', '+40 week'),
            ]);
        }

        foreach (range(0, 100) as $value) {
        DB::table('hotels')->insert([
                'name' => $faker->name,
                'price' => rand(50, 500) * 10,
                'trip_length' => rand(1, 21),
                'country' => $countries[rand(0, 10)],
            ]);
        }
    }
}