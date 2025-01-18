<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Token;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

/**
 *
 */
class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tokens = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('senhapadrao'),
                'token' => '4b5f8f32c96a9aa152e0c6615d4e632f',
                'abilities' => ['client-create', 'client-show', 'client-index', 'balance-get', 'prize-get', 'point-create', 'point-index'],
            ],
            [
                'name' => 'User1',
                'email' => 'user1@mail.com',
                'password' => Hash::make('senhapadrao'),
                'token' => '117ae721e424e7f819893edb2c0c5fd6',
                'abilities' => ['client-show', 'client-index', 'balance-get'],
            ],
            [
                'name' => 'User2',
                'email' => 'user2@mail.com',
                'password' => Hash::make('senhapadrao'),
                'token' => '3b7d6e2cb06ba79a9c9744f8e256a39e',
                'abilities' => ['prize-get', 'point-create'],
            ],
        ];

        foreach ($tokens as $token) {
            $user = User::create([
                'name' => $token['name'],
                'email' => $token['email'],
                'password' => $token['password'],
            ]);

            $user->tokens()->create([
                'name' => 'token' . $user->name,
                'token' => hash('sha256', $token['token']),
                'abilities' => $token['abilities']
            ]);
        }
    }
}
