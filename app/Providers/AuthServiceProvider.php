<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\User\UserPolicy',
        'App\Models\Operation\Operation' => 'App\Policies\Operation\OperationPolicy',
        'App\Models\Order\Order' => 'App\Policies\Order\OrderPolicy',
        'App\Models\Tax\Tax' => 'App\Policies\Tax\TaxPolicy',
        'App\Models\Role\Role' => 'App\Policies\Role\RolePolicy',
        'App\Models\Product\Product' => 'App\Policies\Product\ProductPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
