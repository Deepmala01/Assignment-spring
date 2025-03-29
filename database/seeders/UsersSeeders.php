<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'age' => $faker->numberBetween(18, 65),
                'points' => $faker->numberBetween(0, 100),
                'address' => $faker->address,
                'qr_code_path' => $faker->imageUrl(640, 480, 'cats', true, 'Faker'),
            ]);
        }
        // \DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'age' => 30,
        //     'points' => 50,
        //     'address' => '123 Main St, Anytown, USA',
        //     'qr_code_path' => 'path/to/qr_code.png',
        // ]);
        // \DB::table('users')->insert([

    }
}
