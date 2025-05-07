<?php

namespace Database\Seeders;
use App\Models\Definition;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Definition::insert([
            // Correctas
            ['definition' => 'Fruta roja o verde, jugosa y dulce.', 'word_id' => 1],
            ['definition' => 'Felino salvaje de rayas negras y naranjas.', 'word_id' => 2],
            ['definition' => 'Dispositivo que permite realizar tareas computacionales.', 'word_id' => 3],
            ['definition' => 'Comida rápida italiana con salsa y queso.', 'word_id' => 4],
            ['definition' => 'Animal terrestre grande con trompa.', 'word_id' => 5],
            ['definition' => 'Teléfono inteligente con pantalla táctil.', 'word_id' => 6],
        ]);
    }
}
