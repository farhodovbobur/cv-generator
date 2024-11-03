<?php

namespace App\Http\Controllers\Api;

use App\DTOs\SkillDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $skills = Skill::all();

        $skillDtos = $skills->map(fn($skill) => new SkillDto($skill->toArray()));

        return response()->json($skillDtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $skill = Skill::create($validate);

        $skillDto = new SkillDTO($skill->toArray());

        return response()->json([
            'message' => 'Skill created successfully',
            'date'    => $skillDto
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $skill = Skill::query()->find($id);

        if (!$skill) {
            return response()->json([
                'message' => 'Skill not found'
            ], 404);
        }

        $skillDto = new SkillDTO($skill->toArray());

        return response()->json($skillDto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillRequest $request, string $id): JsonResponse
    {
        $skill = Skill::query()->find($id);

        if (!$skill) {
            return response()->json([
                'message' => 'Skill not found'
            ], 404);
        }

        $validate = $request->validated();

        $skill->update($validate);

        $skillDto = new SkillDTO($skill->toArray());

        return response()->json([
            'message' => 'Skill updated successfully',
            'date'    => $skillDto
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $skill = Skill::query()->find($id);

        if (!$skill) {
            return response()->json([
                'message' => 'Skill not found'
            ], 404);
        }

        $skill->delete();

        return response()->json([
            'message' => 'Skill deleted successfully'
        ], 202);
    }
}
