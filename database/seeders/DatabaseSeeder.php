<?php

use Database\Seeders\UserSeeder;
use Database\Seeders\WargaSeeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(WargaSeeders::class);
    }
}
