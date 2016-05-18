<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);



        $gate->define('insert_vacancy', function($user){
            return $user->type === 1;
        });

        $gate->define('apply_for_vacancy', function($user){
            return $user->type === 2;
        });

        $gate->define('delete_all', function($user){
            return $user->type === 3;
        });

        $gate->define('update_vacancy', function($user,$vacancy){
            return $user->id === $vacancy->user_id;
        });

    }
}
