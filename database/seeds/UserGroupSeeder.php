<?php

use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');

        for($i=1;$i<=4;$i++) {
            for($j=1;$j<=(4-$i);$j++) {
                DB::table('user_group')->insert([
                    'groupID' => $i,
                    'userID' => $j,
                ]);
            }
        }
    }
}