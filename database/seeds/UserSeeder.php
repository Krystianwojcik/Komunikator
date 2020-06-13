<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');

        for($i=1;$i<=4;$i++)
        {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => bcrypt('pass'),
            ]);
        }
        DB::table('users')->insert([
                'name' => 'Michał',
                'surname' => 'Berkowicz',
                'email' => 'a',
                'password' => 'a'
            ]);
    }
}
