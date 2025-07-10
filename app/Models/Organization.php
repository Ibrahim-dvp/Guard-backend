<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'type',
        'code',
        'address',
        'phone',
        'email',
        'logo',
        'settings',
        'status',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Get the teams for the organization.
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
