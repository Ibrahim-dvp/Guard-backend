<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Notification::class);
        $notifications = Notification::all();
        return Helper::jsonResponse(true, 'Notifications retrieved successfully.', 200, $notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $this->authorize('create', Notification::class);
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid()->toString();
        $notification = Notification::create($validated);
        return Helper::jsonResponse(true, 'Notification created successfully.', 201, $notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification): JsonResponse
    {
        $this->authorize('view', $notification);
        return Helper::jsonResponse(true, 'Notification retrieved successfully.', 200, $notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $this->authorize('update', $notification);
        $validated = $request->validated();
        $notification->update($validated);
        return Helper::jsonResponse(true, 'Notification updated successfully.', 200, $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $this->authorize('delete', $notification);
        $notification->delete();
        return Helper::jsonResponse(true, 'Notification deleted successfully.', 204, null);
    }
}
