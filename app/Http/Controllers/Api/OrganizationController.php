<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Organization::class);
        $organizations = Organization::paginate(15);

        return Helper::jsonResponse(
            true,
            'Organizations retrieved successfully.',
            200,
            OrganizationResource::collection($organizations),
            true,
            $organizations
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request): JsonResponse
    {
        $this->authorize('create', Organization::class);
        $organization = Organization::create($request->validated());

        return Helper::jsonResponse(
            status: true,
            message: 'Organization created successfully.',
            code: 201,
            data: new OrganizationResource($organization)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization): JsonResponse
    {
        $this->authorize('view', $organization);

        return Helper::jsonResponse(
            true,
            'Organization retrieved successfully.',
            200,
            new OrganizationResource($organization)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $this->authorize('update', $organization);
        $organization->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Organization updated successfully.',
            200,
            new OrganizationResource($organization)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization): JsonResponse
    {
        $this->authorize('delete', $organization);
        $organization->delete();

        return Helper::jsonResponse(true, 'Organization deleted successfully.', 204);
    }
}
