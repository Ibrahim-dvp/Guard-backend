<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Debug: check what authorize and policy returns
        $user = request()->user();
        $hasPermission = $user ? $user->hasPermissionTo('view-any Role') : false;
        // Log or dd for debugging
        if (!$hasPermission) {
            return Helper::jsonResponse(
                false,
                'Access denied. You do not have permission to view roles.',
                403,
                // ['user_id' => $user ? $user->id : null, 'permissions' => $user ? $user->getPermissionNames() : []]
            );
        }
        // If permission is present, show roles
        $roles = Role::all();
        return Helper::jsonResponse(
            true,
            'Roles retrieved successfully.',
            200,
            RoleResource::collection($roles)
        );
    }
}
