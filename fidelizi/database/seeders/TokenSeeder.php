<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Token;
use Illuminate\Support\Facades\DB;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tokens = [
            [
                'token' => '4b5f8f32c96a9aa152e0c6615d4e632f',
                'permissions' => json_encode(['001', '002', '003', '004', '005', '006', '007']),
            ],
            [
                'token' => '117ae721e424e7f819893edb2c0c5fd6',
                'permissions' => json_encode(['002', '003', '004']),
            ],
            [
                'token' => '3b7d6e2cb06ba79a9c9744f8e256a39e',
                'permissions' => json_encode(['005', '006']),
            ],
        ];

        foreach ($tokens as $token) {
            DB::table('tokens')->insert($token);
        }
    }
}
