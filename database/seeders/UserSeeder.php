<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(DatabaseManager $manager, Hasher $hasher)
    {
        $datatime = Carbon::now()->toDateTimeString();
        //
        $userId = $manager->table('users')
            ->insertGetId(
                [
                    'name' => 'laravel user',
                    'email' => 'mail@example.com',
                    'password' => $hasher->make('password'),
                    'created_at' => $datatime
                ]
            );
            $manager->table('user_tokens')
                ->insert(
                    [
                        'user_id' => $userId,
                        'api_token' => Str::random(60),
                        'created_at' => $datatime
                    ]
                );
    }
}
