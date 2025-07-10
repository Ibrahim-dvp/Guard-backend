<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Appointment::class);
        $appointments = Appointment::all();
        return Helper::jsonResponse(true, 'Appointments retrieved successfully.', 200, $appointments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $this->authorize('create', Appointment::class);
        $validated = $request->validated();
        $validated['uuid'] = Str::uuid()->toString();
        $appointment = Appointment::create($validated);
        return Helper::jsonResponse(true, 'Appointment created successfully.', 201, $appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment): JsonResponse
    {
        $this->authorize('view', $appointment);
        return Helper::jsonResponse(true, 'Appointment retrieved successfully.', 200, $appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $this->authorize('update', $appointment);
        $validated = $request->validated();
        $appointment->update($validated);
        return Helper::jsonResponse(true, 'Appointment updated successfully.', 200, $appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): JsonResponse
    {
        $this->authorize('delete', $appointment);
        $appointment->delete();
        return Helper::jsonResponse(true, 'Appointment deleted successfully.', 204, null);
    }
}
