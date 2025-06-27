<?php

namespace Database\Seeders;

use App\Models\Tasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tasa::create(['tasa' => 100]);
    }
}
