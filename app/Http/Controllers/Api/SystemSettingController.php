<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSystemSettingRequest;
use App\Http\Requests\UpdateSystemSettingRequest;
use App\Http\Resources\SystemSettingResource;
use App\Models\SystemSetting;
use Illuminate\Http\JsonResponse;

class SystemSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', SystemSetting::class);
        $systemSettings = SystemSetting::paginate(15);

        return Helper::jsonResponse(
            true,
            'System settings retrieved successfully.',
            200,
            SystemSettingResource::collection($systemSettings),
            true,
            $systemSettings
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSystemSettingRequest $request): JsonResponse
    {
        $this->authorize('create', SystemSetting::class);
        $systemSetting = SystemSetting::create($request->validated());

        return Helper::jsonResponse(
            true,
            'System setting created successfully.',
            201,
            new SystemSettingResource($systemSetting)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemSetting $systemSetting): JsonResponse
    {
        $this->authorize('view', $systemSetting);

        return Helper::jsonResponse(
            true,
            'System setting retrieved successfully.',
            200,
            new SystemSettingResource($systemSetting)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemSettingRequest $request, SystemSetting $systemSetting): JsonResponse
    {
        $this->authorize('update', $systemSetting);
        $systemSetting->update($request->validated());

        return Helper::jsonResponse(
            true,
            'System setting updated successfully.',
            200,
            new SystemSettingResource($systemSetting)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemSetting $systemSetting): JsonResponse
    {
        $this->authorize('delete', $systemSetting);
        $systemSetting->delete();

        return Helper::jsonResponse(true, 'System setting deleted successfully.', 204);
    }
}
