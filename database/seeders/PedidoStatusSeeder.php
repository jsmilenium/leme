<?php

namespace Database\Seeders;

use App\Models\PedidoStatus;
use Illuminate\Database\Seeder;

class PedidoStatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PedidoStatus::create([
            'descricao' => 'Solicitado',
        ]);

        PedidoStatus::create([
            'descricao' => 'Concluído',
        ]);

        PedidoStatus::create([
            'descricao' => 'Cancelado',
        ]);
    }
}
