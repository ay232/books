<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        $user = User::create([
            'email'     => 'test@test.ru',
            'password'  => '123123123',
            'name'      => $faker->name,
            'email_verified_at' => now(),
        ]);

        $user->createToken('main')->plainTextToken;

    }
}
