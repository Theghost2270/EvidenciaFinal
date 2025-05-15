<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Word;
use App\Models\Option;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Word::insert([
            //comida
            ['id' => 1, 'word' => 'Manzana', 'category_id' => 1],
            ['id' => 7, 'word' => 'Hamburguesa', 'category_id' => 1],
            ['id' => 8, 'word' => 'Taco', 'category_id' => 1],
            ['id' => 9, 'word' => 'Helado', 'category_id' => 1],
            ['id' => 4, 'word' => 'Pizza', 'category_id' => 1],
            //animales
            ['id' => 2, 'word' => 'Tigre', 'category_id' => 2],
            ['id' => 5, 'word' => 'Elefante', 'category_id' => 2],
            ['id' => 10, 'word' => 'Delfín', 'category_id' => 2],
            ['id' => 11, 'word' => 'Pingüino', 'category_id' => 2],
            ['id' => 12, 'word' => 'Jirafa', 'category_id' => 2],
            //tecnologia
            ['id' => 3, 'word' => 'Computadora', 'category_id' => 3],
            ['id' => 6, 'word' => 'Smartphone', 'category_id' => 3],
            ['id' => 13, 'word' => 'Tableta', 'category_id' => 3],
            ['id' => 14, 'word' => 'Impresora', 'category_id' => 3],
            ['id' => 15, 'word' => 'Router', 'category_id' => 3],
            //Deportes
            ['id' => 16, 'word' => 'Fútbol', 'category_id' => 4],
            ['id' => 17, 'word' => 'Tenis', 'category_id' => 4],
            ['id' => 18, 'word' => 'Natación', 'category_id' => 4],
            //Profesiones
            ['id' => 19, 'word' => 'Doctor', 'category_id' => 5],
            ['id' => 20, 'word' => 'Ingeniero', 'category_id' => 5],
            ['id' => 21, 'word' => 'Maestro', 'category_id' => 5],
            //Transporte
            ['id' => 22, 'word' => 'Avión', 'category_id' => 6],
            ['id' => 23, 'word' => 'Tren', 'category_id' => 6],
            ['id' => 24, 'word' => 'Bicicleta', 'category_id' => 6],
        ]);
    }
}
