<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function destroy(User $user, Customer $customer): bool
    {
        return $customer->user->is($user);
    }
}
