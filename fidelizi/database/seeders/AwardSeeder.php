<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('awards')->insert([
            'name' => 'Suco de Laranja',
            'description' => 'Suco natural de laranja, 350ml',
            'points_value' => 5,
        ]);

        DB::table('awards')->insert([
            'name' => '10% de desconto',
            'description' => '10% de desconto em qualquer compra, com oportunidade de conversão de pontos',
            'points_value' => 10,
        ]);

        DB::table('awards')->insert([
            'name' => 'Almoço Especial',
            'description' => 'Almoço em restaurante, especial exclusivo para clientes',
            'points_value' => 20,
        ]);
    }
}
