<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrato;

class ContratoSeeder extends Seeder
{

    public function run()
    {
        Contrato::factory()->count(1000)->create();
    }
}
