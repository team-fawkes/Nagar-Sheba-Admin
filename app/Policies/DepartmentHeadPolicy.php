<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\DepartmentHead;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentHeadPolicy
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
        return $admin->can('view_any_department::head');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\DepartmentHead  $departmentHead
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, DepartmentHead $departmentHead): bool
    {
        return $admin->can('view_department::head');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_department::head');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\DepartmentHead  $departmentHead
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, DepartmentHead $departmentHead): bool
    {
        return $admin->can('update_department::head');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\DepartmentHead  $departmentHead
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, DepartmentHead $departmentHead): bool
    {
        return $admin->can('delete_department::head');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_department::head');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\DepartmentHead  $departmentHead
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, DepartmentHead $departmentHead): bool
    {
        return $admin->can('force_delete_department::head');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('force_delete_any_department::head');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\DepartmentHead  $departmentHead
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, DepartmentHead $departmentHead): bool
    {
        return $admin->can('restore_department::head');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_department::head');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\DepartmentHead  $departmentHead
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(Admin $admin, DepartmentHead $departmentHead): bool
    {
        return $admin->can('replicate_department::head');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_department::head');
    }

}
