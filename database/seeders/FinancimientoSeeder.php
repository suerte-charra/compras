<?php

namespace Database\Seeders;

use App\Models\Financiamiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Financiamiento::create(
            ["nombre" => "Aportaciones federales"],
        );
        Financiamiento::create(
            ["nombre" => "Fais"],
        );
        Financiamiento::create(
            ["nombre" => "Fortamun"],
        );
        Financiamiento::create(
            ["nombre" => "Recurso propio"],
        );
    }
}
