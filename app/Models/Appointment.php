<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lead;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'uuid',
        'lead_id',
        'sales_agent_id',
        'title',
        'description',
        'appointment_date',
        'appointment_time',
        'duration_minutes',
        'location',
        'meeting_type',
        'status',
        'outcome',
        'outcome_notes',
        'reminder_sent',
        'confirmed_by_client',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i:s',
        'reminder_sent' => 'boolean',
        'confirmed_by_client' => 'boolean',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function salesAgent()
    {
        return $this->belongsTo(User::class, 'sales_agent_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
