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
//  for using OAuth passport
//        // OAuth user for a passport
//        \Laravel\Passport\Client::query()->create([
//            'id'                     => 1,
//            'name'                   => 'Laravel Password Grant Client',
//            'secret'                 => 'CyQaejvE9Tq2ykXW1aCz4aYpxU8OEpJngkVWjpHj',
//            'redirect'               => 'http://books.loc',
//            'personal_access_client' => 0,
//            'password_client'        => 1,
//            'revoked'                => 0,
//        ]);
        $user->createToken('main')->plainTextToken;
//
//        \Illuminate\Support\Facades\Artisan::call('passport:install');
    }
}
