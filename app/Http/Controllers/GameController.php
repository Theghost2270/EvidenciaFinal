<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Word;
use App\Models\Definition;
use App\Models\PlayerResult;
use Illuminate\Support\Facades\Crypt;
use App\Models\WordEvent;
use Illuminate\Support\Str;



class GameController extends Controller
{
    public function question(Request $request)
    {
        $categoryId = $request->query('category_id');

        $word = Word::with('definitions')
            ->where('category_id', $categoryId)
            ->inRandomOrder()
            ->first();

        if (!$word || $word->definitions->isEmpty()) {
            return response()->json(['error' => 'No se encontró una palabra con definiciones en esta categoría.'], 404);
        }

        $correctDefinition = $word->definitions->random();

        $incorrectDefinitions = Definition::where('word_id', '!=', $word->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $allDefinitions = collect([$correctDefinition])->merge($incorrectDefinitions)->shuffle();

        // Crear un token encriptado que el frontend enviará luego a /check-answer
        $questionPayload = [
            'word_id' => $word->id,
            'valid_definition_ids' => $allDefinitions->pluck('id')->toArray(),
            'correct_definition_id' => $correctDefinition->id,
        ];

        $questionToken = Crypt::encrypt($questionPayload); // genera el token seguro

        return response()->json([
            'word' => $word->word,
            'definitions' => $allDefinitions->map(fn($def) => [
                'id' => $def->id,
                'text' => $def->definition
            ])->values(),
            'question_token' => $questionToken
        ]);
    }

    public function checkAnswer(Request $request)
    {
        $validated = $request->validate([
            'definition_id' => 'required|integer',
            'question_token' => 'required'
        ]);
    
        try {
            $question = Crypt::decrypt($validated['question_token']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido o alterado.'], 400);
        }
    
        // Verifica que la definición esté entre las opciones válidas
        if (!in_array($validated['definition_id'], $question['valid_definition_ids'])) {
            return response()->json(['error' => 'La definición no pertenece a las opciones de la pregunta.'], 403);
        }
    
        $isCorrect = $validated['definition_id'] == $question['correct_definition_id'];

        $user = auth()->user();
        $wordId = $question['word_id'];
        $eventId = Str::uuid();
    
        // Guardar resultado
        PlayerResult::create([
            'user_id' => auth()->id(),
            'word_id' => $question['word_id'],
            'category_id' => Word::find($question['word_id'])->category_id,
            'is_correct' => $isCorrect,
        ]);
        WordEvent::create([
            'user_id' => $user->id,
            'word_id' => $wordId,
            'user_name' => $user->name, 
            'word_text' => Word::find($wordId)->word,
            'event_id' => $eventId,
            'event' => $isCorrect ? 'correct' : 'incorrect',
            'event_time' => now(),
        ]);

    
        return response()->json([
            'correct' => $isCorrect,
            'message' => $isCorrect ? '¡Correcto!' : 'Incorrecto.'
        ]);
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

    public function wordEvents()
{
    $events = WordEvent::with(['user', 'word'])->get();

    return response()->json($events->map(function ($event) {
        return [
            'id' => $event->id,
            'user_name' => $event->user->name ?? 'Unkown',
            'word' => $event->word->word ?? 'Unknown',
            'event' => $event->event,
            'event_time' => $event->event_time,
        ];
    }));
}

}
