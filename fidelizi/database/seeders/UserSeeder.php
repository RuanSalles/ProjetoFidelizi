<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Ruan Sales',
            'email' => 'admin@mail.com',
            'password' => Hash::make('senhapadrao'),
        ]);

        DB::table('users')->insert([
            'name' => 'User2',
            'email' => 'user2@mail.com',
            'password' => Hash::make('senhapadrao'),
            'fidelity_program' => false,
        ]);
    }
}
