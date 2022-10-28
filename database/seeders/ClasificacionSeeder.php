<?php

namespace Database\Seeders;

use App\Models\Clasificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clasificacion::create(
            ["nombre" => "Adquisición"],
        );
        Clasificacion::create(
            ["nombre" => "Arrendamiento"],
        );
        Clasificacion::create(
            ["nombre" => "Catalogo"],
        );
        Clasificacion::create(
            ["nombre" => "Servicio"],
        );
    }
}
