<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::factory()->create(
            [
                'username' => 'johndoe',
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
            ]
        );
        User::factory()->create(
            [
                'username' => 'janedoe',
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.com',
            ]
        );
    }
}
