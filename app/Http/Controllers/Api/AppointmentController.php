<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Appointment::class);
        $appointments = Appointment::paginate(15);

        return Helper::jsonResponse(
            true,
            'Appointments retrieved successfully.',
            200,
            AppointmentResource::collection($appointments),
            true,
            $appointments
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $this->authorize('create', Appointment::class);
        $appointment = Appointment::create($request->validated());

        return Helper::jsonResponse(
            true,
            'Appointment created successfully.',
            201,
            new AppointmentResource($appointment)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment): JsonResponse
    {
        $this->authorize('view', $appointment);

        return Helper::jsonResponse(
            true,
            'Appointment retrieved successfully.',
            200,
            new AppointmentResource($appointment)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $this->authorize('update', $appointment);
        $appointment->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Appointment updated successfully.',
            200,
            new AppointmentResource($appointment)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): JsonResponse
    {
        $this->authorize('delete', $appointment);
        $appointment->delete();

        return Helper::jsonResponse(true, 'Appointment deleted successfully.', 204);
    }
}
