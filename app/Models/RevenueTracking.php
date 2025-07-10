<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;
use App\Models\User;

class RevenueTracking extends Model
{
    /** @use HasFactory<\Database\Factories\RevenueTrackingFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'lead_id',
        'referral_id',
        'sales_agent_id',
        'deal_value',
        'commission_rate',
        'commission_amount',
        'status',
        'payment_date',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function referral()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }

    public function salesAgent()
    {
        return $this->belongsTo(User::class, 'sales_agent_id');
    }
}
