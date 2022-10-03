<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations\Post;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /* Admin =1 , warhouse_staff =2, user =3 */
        Gate::define('admin-only',function($user){
            if($user->role==1){
                return true;
            }
            return false;
        });
        Gate::define('admin-warehouse_staff',function($user){
            if($user->role==1 ||$user->role==2){
                return true;
            }
            return false;
        });
        Gate::define('user-only',function($user){
            if($user->role==3){
                return true;
            }
            return false;
        });
        Gate::define('check-login',function($user){
            if($user->role!=""){
                return true;
            }
            return false;
        });
    }
}
