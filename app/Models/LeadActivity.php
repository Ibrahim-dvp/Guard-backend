<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;
use App\Models\User;

class LeadActivity extends Model
{
    /** @use HasFactory<\Database\Factories\LeadActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'lead_id',
        'user_id',
        'activity_type',
        'title',
        'description',
        'outcome',
        'activity_date',
        'duration_minutes',
        'metadata',
    ];

    protected $casts = [
        'activity_date' => 'datetime',
        'metadata' => 'array',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
