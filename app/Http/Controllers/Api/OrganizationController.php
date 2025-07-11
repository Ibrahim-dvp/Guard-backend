<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Organization::class);
        $organizations = Organization::all();

        return response()->json([
            'status' => true,
            'message' => 'Organizations retrieved successfully.',
            'data' => OrganizationResource::collection($organizations),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request): JsonResponse
    {
        $this->authorize('create', Organization::class);
        $validated = $request->validated();
        $organization = Organization::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Organization created successfully.',
            'data' => new OrganizationResource($organization),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization): JsonResponse
    {
        $this->authorize('view', $organization);

        return response()->json([
            'status' => true,
            'message' => 'Organization retrieved successfully.',
            'data' => new OrganizationResource($organization),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $this->authorize('update', $organization);
        $validated = $request->validated();
        $organization->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Organization updated successfully.',
            'data' => new OrganizationResource($organization),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization): JsonResponse
    {
        $this->authorize('delete', $organization);
        $organization->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Organization deleted successfully.',
        ], 204);
    }
}
