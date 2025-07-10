<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevenueTracking;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRevenueTrackingRequest;
use App\Http\Requests\UpdateRevenueTrackingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class RevenueTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', RevenueTracking::class);
        $revenueTrackings = RevenueTracking::all();
        return Helper::jsonResponse(true, 'Revenue trackings retrieved successfully.', 200, $revenueTrackings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevenueTrackingRequest $request): JsonResponse
    {
        $this->authorize('create', RevenueTracking::class);
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid()->toString();
        $revenueTracking = RevenueTracking::create($validated);
        return Helper::jsonResponse(true, 'Revenue tracking created successfully.', 201, $revenueTracking);
    }

    /**
     * Display the specified resource.
     */
    public function show(RevenueTracking $revenueTracking): JsonResponse
    {
        $this->authorize('view', $revenueTracking);
        return Helper::jsonResponse(true, 'Revenue tracking retrieved successfully.', 200, $revenueTracking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRevenueTrackingRequest $request, RevenueTracking $revenueTracking): JsonResponse
    {
        $this->authorize('update', $revenueTracking);
        $validated = $request->validated();
        $revenueTracking->update($validated);
        return Helper::jsonResponse(true, 'Revenue tracking updated successfully.', 200, $revenueTracking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RevenueTracking $revenueTracking): JsonResponse
    {
        $this->authorize('delete', $revenueTracking);
        $revenueTracking->delete();
        return Helper::jsonResponse(true, 'Revenue tracking deleted successfully.', 204, null);
    }
}
