<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any categories.
     */
    public function viewAny(User $user): bool
    {
        // Allow any authenticated user to view categories
        return $user != null;
    }

    /**
     * Determine whether the user can view the category.
     */
    public function view(User $user, Category $category): bool
    {
        // Allow viewing if the user is authenticated
        return $user != null;
    }

    /**
     * Determine whether the user can create categories.
     */
    public function create(User $user): bool
    {
        // Allow creation if the user is an admin
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the category.
     */
    public function update(User $user, Category $category): bool
    {
        // Allow updating if the user is an admin
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the category.
     */
    public function delete(User $user, Category $category): bool
    {
        // Allow deleting if the user is an admin
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the category.
     */
    public function restore(User $user, Category $category): bool
    {
        // Allow restoring if the user is an admin
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the category.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        // Allow permanently deleting if the user is an admin
        return $user->is_admin;
    }
}
