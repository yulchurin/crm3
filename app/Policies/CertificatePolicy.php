<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertificatePolicy
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
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $user, Certificate $certificate)
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
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $user, Certificate $certificate)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $user, Certificate $certificate)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user, Certificate $certificate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user, Certificate $certificate)
    {
        //
    }
}
