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
        // $this->call(UsersTableSeeder::class);
        $this->call(\UsersTableSeeder::class);
        $this->call(\EventCategoriesSeeder::class);
        factory(\App\Models\EventPost::class, 100)->create();

    }
}
