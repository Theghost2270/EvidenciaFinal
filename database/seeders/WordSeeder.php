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
            ['id' => 1, 'word' => 'Manzana', 'category_id' => 1],
            ['id' => 2, 'word' => 'Tigre', 'category_id' => 2],
            ['id' => 3, 'word' => 'Computadora', 'category_id' => 3],
            ['id' => 4, 'word' => 'Pizza', 'category_id' => 1],
            ['id' => 5, 'word' => 'Elefante', 'category_id' => 2],
            ['id' => 6, 'word' => 'Smartphone', 'category_id' => 3],
        ]);
        /*
        $comida = Category::create(['name' => 'Comida']);

        $word = Word::create([
            'word' => 'Manzana',
            'definition' => 'Fruta roja o verde que crece en árboles',
            'category_id' => $comida->id,
        ]);
        
        DB::table('words')->insert([
            ['word' => 'Manzana', 'category_id' => 1],
            ['word' => 'Perro', 'category_id' => 2],
        ]);        

        Option::insert([
            ['option_text' => 'Manzana', 'is_correct' => true, 'word_id' => $word->id],
            ['option_text' => 'Perro', 'is_correct' => false, 'word_id' => $word->id],
            ['option_text' => 'Computadora', 'is_correct' => false, 'word_id' => $word->id],
        ]);*/
    }
}
