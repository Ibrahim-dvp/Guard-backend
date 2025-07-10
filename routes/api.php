<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\LeadActivityController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RevenueTrackingController;
use App\Http\Controllers\Api\SystemSettingController;

// Public routes for authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Authenticated user routes
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Resourceful API routes for organizations
    Route::apiResource('organizations', OrganizationController::class);

    // Resourceful API routes for teams
    Route::apiResource('teams', TeamController::class);

    // Resourceful API routes for appointments
    Route::apiResource('appointments', AppointmentController::class);

    // Resourceful API routes for lead activities
    Route::apiResource('lead-activities', LeadActivityController::class);

    // Resourceful API routes for notifications
    Route::apiResource('notifications', NotificationController::class);

    // Resourceful API routes for revenue tracking
    Route::apiResource('revenue-tracking', RevenueTrackingController::class);

    // Resourceful API routes for system settings
    Route::apiResource('system-settings', SystemSettingController::class);
});
