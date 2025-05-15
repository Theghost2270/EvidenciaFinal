<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::insert([
            ['id' => 1, 'name' => 'Comida'],
            ['id' => 2, 'name' => 'Animales'],
            ['id' => 3, 'name' => 'Tecnología'],
            ['id' => 4, 'name' => 'Deportes'],
            ['id' => 5, 'name' => 'Profesiones'],
            ['id' => 6, 'name' => 'Transporte'],
        ]);
    }
}
