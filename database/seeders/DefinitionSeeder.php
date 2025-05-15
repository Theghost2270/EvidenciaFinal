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
            //comida
            ['definition' => 'Fruta roja o verde, jugosa y dulce.', 'word_id' => 1],
            ['definition' => 'Pan redondo con carne, lechuga, tomate y queso.', 'word_id' => 7],
            ['definition' => 'Tortilla doblada rellena de carne, salsa y vegetales.', 'word_id' => 8],
            ['definition' => 'Postre frío y cremoso hecho con leche o fruta.', 'word_id' => 9],
            ['definition' => 'Comida rápida italiana con salsa y queso.', 'word_id' => 4],
            //animales
            ['definition' => 'Felino salvaje de rayas negras y naranjas.', 'word_id' => 2],
            ['definition' => 'Animal terrestre grande con trompa.', 'word_id' => 5],
            ['definition' => 'Mamífero marino inteligente que vive en grupos.', 'word_id' => 10],
            ['definition' => 'Ave que no vuela, vive en zonas frías y nada muy bien.', 'word_id' => 11],
            ['definition' => 'Animal de cuello largo que habita en África.', 'word_id' => 12],
            //tecnologia
            ['definition' => 'Dispositivo que permite realizar tareas computacionales.', 'word_id' => 3],
            ['definition' => 'Teléfono inteligente con pantalla táctil.', 'word_id' => 6],
            ['definition' => 'Dispositivo portátil con pantalla táctil usado para navegar o leer.', 'word_id' => 13],
            ['definition' => 'Equipo que produce copias físicas de documentos digitales.', 'word_id' => 14],
            ['definition' => 'Dispositivo que permite distribuir conexión a Internet.', 'word_id' => 15],
            //Deportes
            ['definition' => 'Deporte en el que dos equipos intentan meter un balón en una portería.', 'word_id' => 16],
            ['definition' => 'Deporte que se juega con raquetas y una pelota pequeña sobre una red.', 'word_id' => 17],
            ['definition' => 'Actividad deportiva que consiste en desplazarse en el agua.', 'word_id' => 18],
            //Profesiones
            ['definition' => 'Persona que estudia y trata enfermedades.', 'word_id' => 19],
            ['definition' => 'Profesional que diseña, construye o mejora estructuras o sistemas.', 'word_id' => 20],
            ['definition' => 'Persona que enseña conocimientos en una institución educativa.', 'word_id' => 21],
            //Transporte
            ['definition' => 'Medio de transporte que vuela y lleva pasajeros a largas distancias.', 'word_id' => 22],
            ['definition' => 'Vehículo que se desplaza sobre rieles.', 'word_id' => 23],
            ['definition' => 'Vehículo de dos ruedas impulsado por pedales.', 'word_id' => 24],
        ]);
    }
}
