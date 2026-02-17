<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Einsatz;
use Illuminate\Auth\Access\HandlesAuthorization;

class EinsatzPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Einsatz');
    }

    public function view(AuthUser $authUser, Einsatz $einsatz): bool
    {
        return $authUser->can('View:Einsatz');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Einsatz');
    }

    public function update(AuthUser $authUser, Einsatz $einsatz): bool
    {
        return $authUser->can('Update:Einsatz');
    }

    public function delete(AuthUser $authUser, Einsatz $einsatz): bool
    {
        return $authUser->can('Delete:Einsatz');
    }

    public function restore(AuthUser $authUser, Einsatz $einsatz): bool
    {
        return $authUser->can('Restore:Einsatz');
    }

    public function forceDelete(AuthUser $authUser, Einsatz $einsatz): bool
    {
        return $authUser->can('ForceDelete:Einsatz');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Einsatz');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Einsatz');
    }

    public function replicate(AuthUser $authUser, Einsatz $einsatz): bool
    {
        return $authUser->can('Replicate:Einsatz');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Einsatz');
    }

}