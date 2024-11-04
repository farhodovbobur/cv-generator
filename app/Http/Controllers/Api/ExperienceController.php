<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ExperienceDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $experiences = Experience::all();

        $experienceDTOs = $experiences->map(fn ($experience) => new ExperienceDTO($experience->toArray()));

        return response()->json($experienceDTOs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $experience = Experience::create($validate);

        $experienceDTO = new ExperienceDTO($experience->toArray());

        return response()->json([
            'message' => 'Experience added successfully',
            'date' => $experienceDTO
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $experience = $this->findOrFail($id);

        $experienceDTO = new ExperienceDTO($experience->toArray());

        return response()->json($experienceDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperienceRequest $request, string $id)
    {
        $experience = $this->findOrFail($id);

        $validate = $request->validated();

        $experience->update($validate);

        $experienceDTO = new ExperienceDTO($experience->toArray());

        return response()->json([
            'message' => 'Experience updated successfully',
            'date' => $experienceDTO
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experience = $this->findOrFail($id);

        $experience->delete();

        return response()->json([
            'message' => 'Experience deleted successfully'
        ], 202);
    }

    private function findOrFail(string $id): Experience
    {
        $experience = Experience::query()->find($id);

        if (!$experience) {
            abort(response()->json([
                'message' => 'Experience not found'
            ], 404));
        }

        return $experience;
    }
}
