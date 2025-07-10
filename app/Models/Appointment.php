<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lead;
use App\Models\User;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory, SoftDeletes;

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
        'appointment_time' => 'array', // Storing time as string or array based on how it's used
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
}
