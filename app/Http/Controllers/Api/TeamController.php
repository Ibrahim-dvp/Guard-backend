<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Team::class);
        $teams = Team::paginate(15);

        return Helper::jsonResponse(
            true,
            'Teams retrieved successfully.',
            200,
            TeamResource::collection($teams),
            true,
            $teams
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): JsonResponse
    {
        $this->authorize('create', Team::class);
        $team = Team::create($request->validated());

        return Helper::jsonResponse(
            true,
            'Team created successfully.',
            201,
            new TeamResource($team)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): JsonResponse
    {
        $this->authorize('view', $team);

        return Helper::jsonResponse(
            true,
            'Team retrieved successfully.',
            200,
            new TeamResource($team)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team): JsonResponse
    {
        $this->authorize('update', $team);
        $team->update($request->validated());

        return Helper::jsonResponse(
            true,
            'Team updated successfully.',
            200,
            new TeamResource($team)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team): JsonResponse
    {
        $this->authorize('delete', $team);
        $team->delete();

        return Helper::jsonResponse(true, 'Team deleted successfully.', 204);
    }
}
