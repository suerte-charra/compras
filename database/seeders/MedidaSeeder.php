<?php

namespace Database\Seeders;

use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medida::create(
            ["nombre" => "Arrendamiento"],
        );
        Medida::create(
            ["nombre" => "Catalogo"],
        );
        Medida::create(
            ["nombre" => "Licencia"],
        );
        Medida::create(
            ["nombre" => "Otros"],
        );
        Medida::create(
            ["nombre" => "Pieza"],
        );
        Medida::create(
            ["nombre" => "Servicio"],
        );
    }
}
