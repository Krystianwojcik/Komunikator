<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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
            DB::table('group')->insert([
                'name' => $faker->city,
            ]);
        }
    }
}
