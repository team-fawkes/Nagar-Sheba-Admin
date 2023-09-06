<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Ward;
use Illuminate\Auth\Access\HandlesAuthorization;

class WardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_ward');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Ward $ward): bool
    {
        return $admin->can('view_ward');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_ward');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Ward $ward): bool
    {
        return $admin->can('update_ward');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Ward $ward): bool
    {
        return $admin->can('delete_ward');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_ward');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Ward $ward): bool
    {
        return $admin->can('force_delete_ward');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('force_delete_any_ward');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Ward $ward): bool
    {
        return $admin->can('restore_ward');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_ward');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(Admin $admin, Ward $ward): bool
    {
        return $admin->can('replicate_ward');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_ward');
    }

}
