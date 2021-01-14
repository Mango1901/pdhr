<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Reward;
use App\Models\User;
use App\Policies\CompanyPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\RewardsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Employee' => 'App\Policies\EmployeePolicy',
         'App\Models\Salary' => 'App\Policies\SalaryPolicy',
         'App\Models\Insurance' => 'App\Policies\InsurancePolicy',
            Department::class => DepartmentPolicy::class,
            Reward::class=>RewardsPolicy::class,
        Company::class => CompanyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            Gate::define('is-admin',function ($user){
                return $user->roles === 1;
            });
    }
}
