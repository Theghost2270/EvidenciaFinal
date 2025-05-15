<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Word;

use App\Models\WordEvent;

class CategoryController extends Controller
{
    //
    public function categories()
{
    $categories = Category::all(['id', 'name']);

    return response()->json([
        'categories' => $categories
    ]);
}

public function search(Request $request)
{
    $query = $request->query('q'); // texto a buscar
    $categoryId = $request->query('category_id'); // opcional
    $startsWith = $request->query('starts_with'); // opcional
    $order = $request->query('order', 'asc');
    $limit = $request->query('limit');

    $words = Word::with('definitions')
        ->when($query, function ($q) use ($query) {
            $q->where('word', 'LIKE', "%$query%")
              ->orWhereHas('definitions', function ($subQuery) use ($query) {
                  $subQuery->where('definition', 'LIKE', "%$query%");
              });
        })
        ->when($categoryId, function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        })
        ->when($startsWith, function ($q) use ($startsWith) {
            $q->where('word', 'LIKE', "$startsWith%");
        })
        ->orderBy('word', $order)
        ->when($limit, function ($q) use ($limit) {
            $q->take((int) $limit);
        })
        ->get();

    $user = auth()->user();
    if ($query && $user) {
        if ($words->isNotEmpty()) {
            foreach ($words as $word) {
                \App\Models\WordEvent::create([
                    'user_id' => $user->id,
                    'word_id' => $word->id,
                    'user_name' => $user->name,
                    'word_text' => $word->word,
                    'event' => 'search_success',
                    'event_time' => now(),
                ]);
            }
        } else {
            \App\Models\WordEvent::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'word_text' => $query,
                'event' => 'search_fail',
                'event_time' => now(),
            ]);
        }
    }

    return response()->json($words);
}



}
