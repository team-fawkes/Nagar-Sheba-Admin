<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\BillCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function viewAny(Admin $admin): bool
//    {
//        return $admin->can('view_any_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can view the model.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @param  \App\Models\BillCategory  $billCategory
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function view(Admin $admin, BillCategory $billCategory): bool
//    {
//        return $admin->can('view_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can create models.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function create(Admin $admin): bool
//    {
//        return $admin->can('create_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can update the model.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @param  \App\Models\BillCategory  $billCategory
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function update(Admin $admin, BillCategory $billCategory): bool
//    {
//        return $admin->can('update_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can delete the model.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @param  \App\Models\BillCategory  $billCategory
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function delete(Admin $admin, BillCategory $billCategory): bool
//    {
//        return $admin->can('delete_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can bulk delete.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function deleteAny(Admin $admin): bool
//    {
//        return $admin->can('delete_any_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can permanently delete.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @param  \App\Models\BillCategory  $billCategory
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function forceDelete(Admin $admin, BillCategory $billCategory): bool
//    {
//        return $admin->can('force_delete_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can permanently bulk delete.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function forceDeleteAny(Admin $admin): bool
//    {
//        return $admin->can('force_delete_any_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can restore.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @param  \App\Models\BillCategory  $billCategory
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function restore(Admin $admin, BillCategory $billCategory): bool
//    {
//        return $admin->can('restore_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can bulk restore.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function restoreAny(Admin $admin): bool
//    {
//        return $admin->can('restore_any_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can replicate.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @param  \App\Models\BillCategory  $billCategory
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function replicate(Admin $admin, BillCategory $billCategory): bool
//    {
//        return $admin->can('replicate_bill::category');
//    }
//
//    /**
//     * Determine whether the admin can reorder.
//     *
//     * @param  \App\Models\Admin  $admin
//     * @return \Illuminate\Auth\Access\Response|bool
//     */
//    public function reorder(Admin $admin): bool
//    {
//        return $admin->can('reorder_bill::category');
//    }

}
