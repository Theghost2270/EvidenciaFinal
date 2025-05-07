<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Word;
use App\Models\Definition;
use App\Models\PlayerResult;

class GameController extends Controller
{
    public function question(Request $request)
    {
        $categoryId = $request->query('category_id');

        // Obtener palabra aleatoria de esa categoría
        $word = Word::with('definitions')
            ->where('category_id', $categoryId)
            ->inRandomOrder()
            ->first();

        if (!$word || $word->definitions->isEmpty()) {
            return response()->json(['error' => 'No se encontró una palabra con definiciones en esta categoría.'], 404);
        }

        // Definición correcta (de esa palabra)
        $correctDefinition = $word->definitions->random();

        // Otras definiciones aleatorias (incorrectas)
        $incorrectDefinitions = Definition::where('word_id', '!=', $word->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Mezclar
        $definitions = collect([$correctDefinition])->merge($incorrectDefinitions)->shuffle();

        return response()->json([
            'word' => $word->word,
            'definitions' => $definitions->map(fn($def) => [
                'id' => $def->id,
                'text' => $def->definition
            ])->values()
        ]);
    }


    public function checkAnswer(Request $request)
    {
        $validated = $request->validate([
            'definition_id' => 'required|exists:definitions,id',
            'word_id' => 'required|exists:words,id',
        ]);
    
        $definition = Definition::find($validated['definition_id']);
        $word = Word::find($validated['word_id']);
    
        $isCorrect = $definition->word_id === $word->id;
    
        // Guardar el resultado
        PlayerResult::create([
            'user_id' => auth()->id(),
            'word_id' => $word->id,
            'category_id' => $word->category_id,
            'is_correct' => $isCorrect,
        ]);
    
        return response()->json([
            'message' => $isCorrect ? '¡Correcto!' : 'Incorrecto. Intenta de nuevo.',
            'correct' => $isCorrect
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->query('q'); // este viene del request, ej: ?q=perro
    
        $words = Word::where('word', 'LIKE', "%$query%")
            ->orWhereHas('definitions', function ($q) use ($query) {
                $q->where('definition', 'LIKE', "%$query%");
            })
            ->with('definitions')
            ->get();
    
        return response()->json($words);
    }

    public function stats()
    {
        $user = auth()->user();

        $results = PlayerResult::where('user_id', $user->id)
            ->with('category')
            ->get()
            ->groupBy('category.name');

        $summary = [];

        foreach ($results as $category => $items) {
            $summary[$category] = [
                'correct' => $items->where('is_correct', true)->count(),
                'incorrect' => $items->where('is_correct', false)->count()
            ];
        }

        return response()->json($summary);
    }
}
