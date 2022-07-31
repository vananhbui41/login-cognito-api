<?php

namespace Database\Seeders;

use App\Models\Account;
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
        // \App\Models\User::factory(10)->create();
        Account::create([
            'email' => 'vananhbui41@gmail.com',
            'cognito_user_id' => '35583153-6a43-414c-8877-f3cace3ef8dd',
        ]);
    }
}
