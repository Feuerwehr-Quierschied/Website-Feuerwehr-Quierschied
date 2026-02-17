<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Aktuelles;
use Illuminate\Auth\Access\HandlesAuthorization;

class AktuellesPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Aktuelles');
    }

    public function view(AuthUser $authUser, Aktuelles $aktuelles): bool
    {
        return $authUser->can('View:Aktuelles');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Aktuelles');
    }

    public function update(AuthUser $authUser, Aktuelles $aktuelles): bool
    {
        return $authUser->can('Update:Aktuelles');
    }

    public function delete(AuthUser $authUser, Aktuelles $aktuelles): bool
    {
        return $authUser->can('Delete:Aktuelles');
    }

    public function restore(AuthUser $authUser, Aktuelles $aktuelles): bool
    {
        return $authUser->can('Restore:Aktuelles');
    }

    public function forceDelete(AuthUser $authUser, Aktuelles $aktuelles): bool
    {
        return $authUser->can('ForceDelete:Aktuelles');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Aktuelles');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Aktuelles');
    }

    public function replicate(AuthUser $authUser, Aktuelles $aktuelles): bool
    {
        return $authUser->can('Replicate:Aktuelles');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Aktuelles');
    }

}