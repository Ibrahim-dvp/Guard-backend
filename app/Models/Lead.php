<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;

class Lead extends Model
{
    /** @use HasFactory<\Database\Factories\LeadFactory> */
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'uuid',
        'lead_number',
        'client_first_name',
        'client_last_name',
        'client_email',
        'client_phone',
        'client_address',
        'client_city',
        'client_country',
        'product_interest',
        'budget_range',
        'timeline',
        'priority',
        'source',
        'notes',
        'status',
        'substatus',
        'referral_id',
        'assigned_to',
        'organization_id',
        'team_id',
        'wordpress_form_id',
        'baserow_id',
        'assigned_at',
        'first_contact_at',
        'last_activity_at',
        'estimated_value',
        'actual_value',
        'commission_rate',
        'commission_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function activities()
    {
        return $this->hasMany(LeadActivity::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function revenueTracking()
    {
        return $this->hasMany(RevenueTracking::class);
    }
}
