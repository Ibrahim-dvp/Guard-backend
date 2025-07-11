<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    /** @use HasFactory<\Database\Factories\SystemSettingFactory> */
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'key',
        'value',
        'type',
        'description',
        'is_public',
    ];
}
