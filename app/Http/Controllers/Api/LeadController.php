<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Lead::class);
        $leads = Lead::all();
        return Helper::jsonResponse(true, 'Leads retrieved successfully.', 200, $leads);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request): JsonResponse
    {
        $this->authorize('create', Lead::class);
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid()->toString();
        $lead = Lead::create($validated);
        return Helper::jsonResponse(true, 'Lead created successfully.', 201, $lead);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead): JsonResponse
    {
        $this->authorize('view', $lead);
        return Helper::jsonResponse(true, 'Lead retrieved successfully.', 200, $lead);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, Lead $lead): JsonResponse
    {
        $this->authorize('update', $lead);
        $validated = $request->validated();
        $lead->update($validated);
        return Helper::jsonResponse(true, 'Lead updated successfully.', 200, $lead);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead): JsonResponse
    {
        $this->authorize('delete', $lead);
        $lead->delete();
        return Helper::jsonResponse(true, 'Lead deleted successfully.', 204, null);
    }
}
