<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Award::create([
            'name' => 'Suco de Laranja',
            'description' => 'Suco natural de laranja, 350ml',
            'points_value' => 5,
        ]);

        Award::create([
            'name' => '10% de desconto',
            'description' => '10% de desconto em qualquer compra, com oportunidade de conversão de pontos',
            'points_value' => 10,
        ]);

        Award::create([
            'name' => 'Almoço Especial',
            'description' => 'Almoço em restaurante, especial exclusivo para clientes',
            'points_value' => 20,
        ]);
    }
}
