<?php

namespace App\Policies;

use App\Models\OtherSalary;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OtherSalaryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OtherSalary  $otherSalary
     * @return mixed
     */
    public function view(User $user, OtherSalary $otherSalary)
    {
        if($user->roles == 1){
            return $user->company_id === $otherSalary->company_id;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OtherSalary  $otherSalary
     * @return mixed
     */
    public function update(User $user, OtherSalary $otherSalary)
    {
        if($user->roles == 1){
            return $user->company_id === $otherSalary->company_id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OtherSalary  $otherSalary
     * @return mixed
     */
    public function delete(User $user, OtherSalary $otherSalary)
    {
        if($user->roles == 1){
            return $user->company_id === $otherSalary->company_id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OtherSalary  $otherSalary
     * @return mixed
     */
    public function restore(User $user, OtherSalary $otherSalary)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OtherSalary  $otherSalary
     * @return mixed
     */
    public function forceDelete(User $user, OtherSalary $otherSalary)
    {
        //
    }
}
