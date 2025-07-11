<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Resources\LeadResource;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Lead::class);
        $leads = Lead::paginate(15);

        return Helper::jsonResponse(
            true,
            'Leads retrieved successfully.',
            200,
            LeadResource::collection($leads),
            true,
            $leads
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request): JsonResponse
    {
        $this->authorize('create', Lead::class);
        $lead = Lead::create($request->validated());

        return Helper::jsonResponse(
            true,
            'Lead created successfully.',
            201,
            new LeadResource($lead)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead): JsonResponse
    {
        $this->authorize('view', $lead);

        return Helper::jsonResponse(
            true,
            'Lead retrieved successfully.',
            200,
            new LeadResource($lead)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, Lead $lead): JsonResponse
    {
        $this->authorize('update', $lead);
        $lead->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Lead updated successfully.',
            200,
            new LeadResource($lead)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead): JsonResponse
    {
        $this->authorize('delete', $lead);
        $lead->delete();

        return Helper::jsonResponse(true, 'Lead deleted successfully.', 204);
    }
}

