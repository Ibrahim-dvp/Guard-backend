<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Organization::class);
        $organizations = Organization::all();
        return Helper::jsonResponse(true, 'Organizations retrieved successfully.', 200, $organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request): JsonResponse
    {
        $this->authorize('create', Organization::class);
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid()->toString();
        $organization = Organization::create($validated);
        return Helper::jsonResponse(true, 'Organization created successfully.', 201, $organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization): JsonResponse
    {
        $this->authorize('view', $organization);
        return Helper::jsonResponse(true, 'Organization retrieved successfully.', 200, $organization);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $this->authorize('update', $organization);
        $validated = $request->validated();
        $organization->update($validated);
        return Helper::jsonResponse(true, 'Organization updated successfully.', 200, $organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization): JsonResponse
    {
        $this->authorize('delete', $organization);
        $organization->delete();
        return Helper::jsonResponse(true, 'Organization deleted successfully.', 204, null);
    }
}
