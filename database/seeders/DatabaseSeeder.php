<?php

namespace Database\Seeders;

use App\Models\User;
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
        $this->call(DemoUserSeeder::class);
        $this->call(LibrarySeeder::class);
        User::factory()->count(10)->create();

    }
}
