<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $query = Translation::query();

        if ($request->has('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('tag', $request->tag));
        }

        if ($request->has('locale')) {
            $query->where('locale', $request->locale);
        }

        return response()->json($query->paginate(50));
    }

    public function store(Request $request)
    {
        $request->validate([
            'locale' => 'required|string',
            'key' => 'required|string|unique:translations,key',
            'value' => 'required|string',
            'tags' => 'array'
        ]);

        $translation = Translation::create($request->only('locale', 'key', 'value'));

        if ($request->has('tags')) {
            $tagIds = Tag::whereIn('tag', $request->tags)->pluck('id');
            $translation->tags()->sync($tagIds);
        }

        return response()->json(['message' => 'Translation added successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $translation = Translation::findOrFail($id);

        $request->validate([
            'locale' => 'sometimes|string',
            'key' => 'sometimes|string|unique:translations,key,' . $id,
            'value' => 'sometimes|string',
            'tags' => 'array'
        ]);

        $translation->update($request->only('locale', 'key', 'value'));

        if ($request->has('tags')) {
            $tagIds = Tag::whereIn('tag', $request->tags)->pluck('id');
            $translation->tags()->sync($tagIds);
        }

        return response()->json(['message' => 'Translation updated successfully']);
    }

    public function destroy($id)
    {
        $translation = Translation::findOrFail($id);
        $translation->delete();

        return response()->json(['message' => 'Translation deleted successfully']);
    }

    public function exportJson()
    {
        return response()->json(Translation::all()->pluck('value', 'key'));
    }

}
