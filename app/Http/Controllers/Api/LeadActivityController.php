<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeadActivity;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLeadActivityRequest;
use App\Http\Requests\UpdateLeadActivityRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class LeadActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', LeadActivity::class);
        $leadActivities = LeadActivity::all();
        return Helper::jsonResponse(true, 'Lead activities retrieved successfully.', 200, $leadActivities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadActivityRequest $request): JsonResponse
    {
        $this->authorize('create', LeadActivity::class);
        $validated = $request->validated();
        $leadActivity = LeadActivity::create($validated);
        return Helper::jsonResponse(true, 'Lead activity created successfully.', 201, $leadActivity);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeadActivity $leadActivity): JsonResponse
    {
        $this->authorize('view', $leadActivity);
        return Helper::jsonResponse(true, 'Lead activity retrieved successfully.', 200, $leadActivity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadActivityRequest $request, LeadActivity $leadActivity): JsonResponse
    {
        $this->authorize('update', $leadActivity);
        $validated = $request->validated();
        $leadActivity->update($validated);
        return Helper::jsonResponse(true, 'Lead activity updated successfully.', 200, $leadActivity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeadActivity $leadActivity): JsonResponse
    {
        $this->authorize('delete', $leadActivity);
        $leadActivity->delete();
        return Helper::jsonResponse(true, 'Lead activity deleted successfully.', 204, null);
    }
}
