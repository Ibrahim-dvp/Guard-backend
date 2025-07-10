<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'avatar',
        'status',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    // Relationships
    public function organizations()
    {
        return $this->belongsToMany(\App\Models\Organization::class, 'user_roles');
    }

    public function teams()
    {
        return $this->belongsToMany(\App\Models\Team::class, 'user_roles');
    }

    public function leadsCreated()
    {
        return $this->hasMany(\App\Models\Lead::class, 'user_id');
    }

    public function leadsAssigned()
    {
        return $this->hasMany(\App\Models\Lead::class, 'assigned_to');
    }

    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'sales_agent_id');
    }

    public function notificationsSent()
    {
        return $this->hasMany(\App\Models\Notification::class, 'sender_id');
    }

    public function notificationsReceived()
    {
        return $this->hasMany(\App\Models\Notification::class, 'recipient_id');
    }

    public function leadActivities()
    {
        return $this->hasMany(\App\Models\LeadActivity::class);
    }

    public function revenueTrackings()
    {
        return $this->hasMany(\App\Models\RevenueTracking::class, 'sales_agent_id');
    }
}
