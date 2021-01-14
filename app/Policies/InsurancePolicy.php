<?php

namespace App\Policies;

use App\Models\Insurance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InsurancePolicy
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
     * @param  \App\Models\Insurance  $insurance
     * @return mixed
     */
    public function view(User $user, Insurance $insurance)
    {
        if($user->roles == 1){
            return $user->company_id === $insurance->company_id;
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
        if($user->roles == 1){
            return $user->true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Insurance  $insurance
     * @return mixed
     */
    public function update(User $user, Insurance $insurance)
    {
        if($user->roles == 1){
            return $user->company_id === $insurance->company_id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Insurance  $insurance
     * @return mixed
     */
    public function delete(User $user, Insurance $insurance)
    {
        if($user->roles == 1){
            return $user->company_id === $insurance->company_id;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Insurance  $insurance
     * @return mixed
     */
    public function restore(User $user, Insurance $insurance)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Insurance  $insurance
     * @return mixed
     */
    public function forceDelete(User $user, Insurance $insurance)
    {
        //
    }
}
