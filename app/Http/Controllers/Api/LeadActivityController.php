<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadActivityRequest;
use App\Http\Requests\UpdateLeadActivityRequest;
use App\Http\Resources\LeadActivityResource;
use App\Models\LeadActivity;
use Illuminate\Http\JsonResponse;

class LeadActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', LeadActivity::class);
        $leadActivities = LeadActivity::paginate(15);

        return Helper::jsonResponse(
            true,
            'Lead activities retrieved successfully.',
            200,
            LeadActivityResource::collection($leadActivities),
            true,
            $leadActivities
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadActivityRequest $request): JsonResponse
    {
        $this->authorize('create', LeadActivity::class);
        $leadActivity = LeadActivity::create($request->validated());

        return Helper::jsonResponse(
            true,
            'Lead activity created successfully.',
            201,
            new LeadActivityResource($leadActivity)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(LeadActivity $leadActivity): JsonResponse
    {
        $this->authorize('view', $leadActivity);

        return Helper::jsonResponse(
            true,
            'Lead activity retrieved successfully.',
            200,
            new LeadActivityResource($leadActivity)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadActivityRequest $request, LeadActivity $leadActivity): JsonResponse
    {
        $this->authorize('update', $leadActivity);
        $leadActivity->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Lead activity updated successfully.',
            200,
            new LeadActivityResource($leadActivity)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeadActivity $leadActivity): JsonResponse
    {
        $this->authorize('delete', $leadActivity);
        $leadActivity->delete();

        return Helper::jsonResponse(true, 'Lead activity deleted successfully.', 204);
    }
}
