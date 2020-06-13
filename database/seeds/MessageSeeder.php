<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');

        for($i=1;$i<=100;$i++)
        {
            $GroupID = $faker->numberBetween(1, 2);
            if($GroupID == 1) {
                $UserID = $faker->numberBetween(1, 3);
            } else {
                $UserID = $faker->numberBetween(1, 2);
            }
            DB::table('chats')->insert([
                'groupID' => $GroupID,
                'user_id' => $UserID,
                'message' => $faker->sentence(6),
                'status' => $faker->numberBetween(0, 1)
            ]);
        }
    }
}
