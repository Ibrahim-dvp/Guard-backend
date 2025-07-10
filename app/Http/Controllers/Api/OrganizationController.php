<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $organizations = Organization::all();
        return response()->json($organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid()->toString();
        $organization = Organization::create($validated);
        return response()->json($organization, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization): JsonResponse
    {
        return response()->json($organization);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $validated = $request->validated();
        $organization->update($validated);
        return response()->json($organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization): JsonResponse
    {
        $organization->delete();
        return response()->json(null, 204);
    }
}
