<?php

namespace App\Http\Controllers\Api;

use App\DTOs\EducationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $educations = Education::all();

        $educationDTOs = $educations->map(fn($education) => new EducationDTO($education->toArray()));

        return response()->json($educationDTOs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $education = Education::create($validate);

        $educationDTO = new EducationDTO($education->toArray());

        return response()->json([
            'message' => 'Education created successfully.',
            'date'    => $educationDTO
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $education = $this->findOrFail($id);

        $educationDTO = new EducationDTO($education->toArray());

        return response()->json($educationDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationRequest $request, string $id): JsonResponse
    {
        $education = $this->findOrFail($id);

        $validate = $request->validated();

        $education->update($validate);

        $educationDTO = new EducationDTO($education->toArray());

        return response()->json([
            'message' => 'Education updated successfully.',
            'date'    => $educationDTO
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $education = $this->findOrFail($id);

        $education->delete();

        return response()->json([
            'message' => 'Education deleted successfully.'
        ], 202);
    }

    private function findOrFail(string $id): Education
    {
        $education = Education::query()->find($id);

        if (!$education) {
            abort(response()->json([
                'message' => 'Education not found'
            ], 404));
        }

        return $education;
    }
}
