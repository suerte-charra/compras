<?php

namespace Database\Seeders;

use App\Models\Dependencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dependencia::create(
            ["nombre" => "Dirección de Informatica"],
        );
        Dependencia::create(
            ["nombre" => "Dirección de Parques y Jardines"],
        );
    }
}
