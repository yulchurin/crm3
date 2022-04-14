<?php

namespace App\Policies;

use App\Models\Passport;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PassportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, Passport $passport)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, Passport $passport)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, Passport $passport)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, Passport $passport)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, Passport $passport)
    {
        //
    }
}
