<?php

namespace App\Http\Controllers\Api;

use App\DTOs\LanguageDTO;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $languages = Language::all();

        $languageDTOs = $languages->map(fn ($language) => new LanguageDTO($language->toArray()));

        return response()->json($languageDTOs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $language = $this->findOrFail($id);

        $languageDTO = new LanguageDTO($language->toArray());

        return response()->json($languageDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function findOrFail(string $id): Language
    {
        $language = Language::query()->find($id);

        if (!$language) {
            abort(response()->json([
                'message' => 'Language not found'
            ], 404));
        }

        return $language;
    }
}
