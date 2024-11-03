<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ProjectDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $projects = Project::all();

        $projectDTOs = $projects->map(fn($project) => new ProjectDTO($project->toArray()));

        return response()->json($projectDTOs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $project = Project::create($validate);

        $projectDTO = new ProjectDTO($project->toArray());

        return response()->json([
            'message' => 'Project created successfully',
            'data'    => $projectDTO
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $project = $this->findOrFail($id);

        $projectDTO = new ProjectDTO($project->toArray());

        return response()->json($projectDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id): JsonResponse
    {
        $project = $this->findOrFail($id);

        $validate = $request->validated();

        $project->update($validate);

        $projectDTO = new ProjectDTO($project->toArray());

        return response()->json([
            'message' => 'Project updated successfully',
            'data'    => $projectDTO
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $project = $this->findOrFail($id);

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ], 202);

    }

    private function findOrFail(string $id): Project
    {
        $project = Project::query()->find($id);

        if (!$project) {
            abort(response()->json([
                'message' => 'Project not found'
            ], 404));
        }

        return $project;
    }
}
