<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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
                'role' => UserRole::ADMIN->value,
            ]
        );
        User::factory()->create(
            [
                'username' => 'janedoe',
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.com',
                'role' => UserRole::USER->value,
            ]
        );
    }
}
