<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    //Determina si el cliente puede ver cualquier payment.
    public function viewAny(User $user)
    {
        return true;
    }

    //Determina si el cliente puede ver este payment.
    public function view(User $user, Payment $payment)
    {
        return $user->id === $payment->user_id;
    }

    //Determina si el cliente puede crear payment.
    public function create(User $user)
    {
        return true;
    }

    //Determina si el cliente puede actualizar este payment.
    public function update(User $user, Payment $payment)
    {
        return $user->id === $payment->user_id;
    }

    //Determina si el cliente puede borrar este payment.
    public function delete(User $user, Payment $payment)
    {
        return $user->id === $payment->user_id;
    }
}
