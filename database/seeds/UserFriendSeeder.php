<?php

use Illuminate\Database\Seeder;

class UserFriendSeeder extends Seeder
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
                if($i != $j) {
                    DB::table('user_friend')->insert([
                        'userID' => $i,
                        'friendID' => $j,
                    ]);
                }
            }
        }
                    DB::table('user_friend')->insert([
                        'userID' => 5,
                        'friendID' => 4,
                    ]);
    }
}