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
        $this->call(QuestionSetSeeder::class);
        // $this->call(QuestionSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
