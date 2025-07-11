<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRevenueTrackingRequest;
use App\Http\Requests\UpdateRevenueTrackingRequest;
use App\Http\Resources\RevenueTrackingResource;
use App\Models\RevenueTracking;
use Illuminate\Http\JsonResponse;

class RevenueTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', RevenueTracking::class);
        $revenueTrackings = RevenueTracking::paginate(15);

        return Helper::jsonResponse(
            true,
            'Revenue tracking records retrieved successfully.',
            200,
            RevenueTrackingResource::collection($revenueTrackings),
            true,
            $revenueTrackings
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevenueTrackingRequest $request): JsonResponse
    {
        $this->authorize('create', RevenueTracking::class);
        $revenueTracking = RevenueTracking::create($request->validated());

        return Helper::jsonResponse(
            true,
            'Revenue tracking record created successfully.',
            201,
            new RevenueTrackingResource($revenueTracking)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(RevenueTracking $revenueTracking): JsonResponse
    {
        $this->authorize('view', $revenueTracking);

        return Helper::jsonResponse(
            true,
            'Revenue tracking record retrieved successfully.',
            200,
            new RevenueTrackingResource($revenueTracking)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRevenueTrackingRequest $request, RevenueTracking $revenueTracking): JsonResponse
    {
        $this->authorize('update', $revenueTracking);
        $revenueTracking->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Revenue tracking record updated successfully.',
            200,
            new RevenueTrackingResource($revenueTracking)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RevenueTracking $revenueTracking): JsonResponse
    {
        $this->authorize('delete', $revenueTracking);
        $revenueTracking->delete();

        return Helper::jsonResponse(true, 'Revenue tracking record deleted successfully.', 204);
    }
}
