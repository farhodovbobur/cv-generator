<?php

namespace App\Http\Controllers\Api;

use App\DTOs\LevelDTO;
use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $levels = Level::all();

        $levelDTOs = $levels->map(fn($level) => new LevelDTO($level->toArray()));

        return response()->json($levelDTOs);
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
        $level = $this->findOrFail($id);

        $levelDTO = new LevelDTO($level->toArray());

        return response()->json($levelDTO);
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

    private function findOrFail(string $id): Level
    {
        $level = Level::query()->find($id);

        if (!$level) {
            abort(response()->json([
                'message' => 'Level not found'
            ], 404));
        }

        return $level;
    }
}
