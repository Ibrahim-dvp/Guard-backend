<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use Illuminate\Http\JsonResponse;
use App\Helpers\Helper;

class SystemSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', SystemSetting::class);
        $systemSettings = SystemSetting::all();
        return Helper::jsonResponse(true, 'System settings retrieved successfully.', 200, $systemSettings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSystemSettingRequest $request): JsonResponse
    {
        $this->authorize('create', SystemSetting::class);
        $validated = $request->validated();
        $systemSetting = SystemSetting::create($validated);
        return Helper::jsonResponse(true, 'System setting created successfully.', 201, $systemSetting);
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemSetting $systemSetting): JsonResponse
    {
        $this->authorize('view', $systemSetting);
        return Helper::jsonResponse(true, 'System setting retrieved successfully.', 200, $systemSetting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemSettingRequest $request, SystemSetting $systemSetting): JsonResponse
    {
        $this->authorize('update', $systemSetting);
        $validated = $request->validated();
        $systemSetting->update($validated);
        return Helper::jsonResponse(true, 'System setting updated successfully.', 200, $systemSetting);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemSetting $systemSetting): JsonResponse
    {
        $this->authorize('delete', $systemSetting);
        $systemSetting->delete();
        return Helper::jsonResponse(true, 'System setting deleted successfully.', 204, null);
    }
}
