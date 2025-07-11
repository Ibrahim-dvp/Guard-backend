<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Notification::class);
        $notifications = Notification::paginate(15);

        return Helper::jsonResponse(
            true,
            'Notifications retrieved successfully.',
            200,
            NotificationResource::collection($notifications),
            true,
            $notifications
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $this->authorize('create', Notification::class);
        $notification = Notification::create($request->validated());

        return Helper::jsonResponse(
            true,
            'Notification created successfully.',
            201,
            new NotificationResource($notification)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification): JsonResponse
    {
        $this->authorize('view', $notification);

        return Helper::jsonResponse(
            true,
            'Notification retrieved successfully.',
            200,
            new NotificationResource($notification)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $this->authorize('update', $notification);
        $notification->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Notification updated successfully.',
            200,
            new NotificationResource($notification)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $this->authorize('delete', $notification);
        $notification->delete();

        return Helper::jsonResponse(true, 'Notification deleted successfully.', 204);
    }
}

