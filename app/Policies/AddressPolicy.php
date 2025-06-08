<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    //Determina si el cliente puede ver cualquier dirección.
    public function viewAny(User $user)
    {
        return true;
    }

    //Determina si el cliente puede ver esta dirección.
    public function view(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    //Determina si el cliente puede crear direcciones.
    public function create(User $user)
    {
        return true;
    }

    //Determina si el cliente puede modificar direcciones.
    public function update(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    //Determina si el cliente puede eliminar direcciones.
    public function delete(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }
}
