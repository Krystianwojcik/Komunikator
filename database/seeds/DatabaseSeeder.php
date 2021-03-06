<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(UserGroupSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(UserFriendSeeder::class);
    }
}
