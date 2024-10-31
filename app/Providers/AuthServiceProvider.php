<?php

namespace App\Providers;

use App\Models\Komentar;
use App\Policies\KomentarPolicy;
use App\Models\Komunitas;
use App\Policies\KomunitasPolicy;
use App\Models\GuideBook;
use App\Policies\GuideBookPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Komunitas::class => KomunitasPolicy::class,
        Komentar::class => KomentarPolicy::class,
        GuideBook::class => GuideBookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
