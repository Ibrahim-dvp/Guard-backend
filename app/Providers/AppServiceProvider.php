<?php

namespace App\Providers;

use App\Models\Organization;
use App\Policies\OrganizationPolicy;
use App\Models\Team;
use App\Policies\TeamPolicy;
use App\Models\Lead;
use App\Policies\LeadPolicy;
use App\Models\Appointment;
use App\Policies\AppointmentPolicy;
use App\Models\LeadActivity;
use App\Policies\LeadActivityPolicy;
use App\Models\Notification;
use App\Policies\NotificationPolicy;
use App\Models\RevenueTracking;
use App\Policies\RevenueTrackingPolicy;
use App\Models\SystemSetting;
use App\Policies\SystemSettingPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
        Team::class         => TeamPolicy::class,
        Lead::class         => LeadPolicy::class,
        Appointment::class  => AppointmentPolicy::class,
        LeadActivity::class => LeadActivityPolicy::class,
        Notification::class => NotificationPolicy::class,
        RevenueTracking::class => RevenueTrackingPolicy::class,
        SystemSetting::class => SystemSettingPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
