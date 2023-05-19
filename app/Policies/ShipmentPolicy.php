<?php

namespace App\Policies;

use App\Models\Shipment;
use App\Models\User;

class ShipmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(['view_all_shipments']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Shipment $shipment): bool
    {
        return $this->viewAny($user) || $user->id == $shipment->user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Shipment $shipment): bool
    {
        return $user->can(['edit_all_shipments']) || $user->id == $shipment->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Shipment $shipment): bool
    {
        return $user->can(['delete_any_shipment']);
    }

    /**
     * Determine whether the user can accept any shipment request.
     */
    public function acceptAny(User $user): bool
    {
        return $user->can(['accept_any_shipment']);
    }

    /**
     * Determine whether the user can accept the shipment request.
     */
    public function accept(User $user, Shipment $shipment): bool
    {
        return $this->acceptAny($user);
    }
}
