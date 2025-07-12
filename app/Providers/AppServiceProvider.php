<?php

namespace App\Providers;

use App\Models\Lead;
use App\Models\Team;
use App\Models\User;
use App\Models\Appointment;
use App\Models\LeadActivity;
use App\Models\Notification;
use App\Models\Organization;
use App\Policies\LeadPolicy;
use App\Policies\RolePolicy;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use App\Models\SystemSetting;
use App\Models\RevenueTracking;
use App\Policies\AppointmentPolicy;
use App\Policies\LeadActivityPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\SystemSettingPolicy;
use Spatie\Permission\Models\Role;
use App\Policies\RevenueTrackingPolicy;
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
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
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
