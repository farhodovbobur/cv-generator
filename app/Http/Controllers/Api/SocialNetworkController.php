<?php

namespace App\Http\Controllers\Api;

use App\DTOs\SocialNetworkDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialNetworkRequest;
use App\Http\Requests\UpdateSocialNetworkRequest;
use App\Models\SocialNetwork;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $networks = SocialNetwork::all();

        $networkDtos = $networks->map(fn($network) => new SocialNetworkDTO($network->toArray()));

        return response()->json($networkDtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialNetworkRequest $request)
    {
        $validate = $request->validated();

        $network = SocialNetwork::create($validate);

        $networkDto = new SocialNetworkDTO($network->toArray());

        return response()->json([
            'message' => 'Social network created successfully.',
            'date'    => $networkDto
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $network = SocialNetwork::query()->find($id);

        if (!$network) {
            return response()->json([
                'message' => 'Social Network not found'
            ], 404);
        }

        $networkDto = new SocialNetworkDTO($network->toArray());

        return response()->json($networkDto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialNetworkRequest $request, string $id): JsonResponse
    {
        $network = SocialNetwork::query()->find($id);

        if (!$network) {
            return response()->json([
                'message' => 'Social Network not found'
            ], 404);
        }

        $validate = $request->validated();

        $network->update($validate);

        $networkDto = new SocialNetworkDTO($network->toArray());

        return response()->json([
            'message' => 'Social network updated successfully.',
            'date'    => $networkDto
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $network = SocialNetwork::query()->find($id);

        if (!$network) {
            return response()->json([
                'message' => 'Social Network not found'
            ], 404);
        }

        $network->delete();

        return response()->json([
            'message' => 'Social network deleted successfully.'
        ], 202);
    }
}
