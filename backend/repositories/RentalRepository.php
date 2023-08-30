<?php

namespace backend\repositories;

use backend\repositories\RentalRepositoryInterface;

class RentalRepository implements RentalRepositoryInterface
{

    public function createRental($rental)
    {
        // TODO: Implement createRental() method.
    }

    public function updateRental($rental)
    {
        // TODO: Implement updateRental() method.
    }

    public function deleteRental($rental)
    {
        // TODO: Implement deleteRental() method.
    }

    public function getRentalById($id)
    {
        // TODO: Implement getRentalById() method.
    }

    public function getAllRentalsByUserId($id)
    {
        // TODO: Implement getAllRentalsByUserId() method.
    }

    public function getAllRentalsByProductId($id)
    {
        // TODO: Implement getAllRentalsByProductId() method.
    }

    public function getAllRentals()
    {
        // TODO: Implement getAllRentals() method.
    }

    public function addAdditionalTimeToRentalByUniqueCode($uniqueCode, $additionalTime)
    {
        // TODO: Implement addAdditionalTimeToRentalByUniqueCode() method.
    }

    public function cancelRentalByUniqueCode($uniqueCode)
    {
        // TODO: Implement cancelRentalByUniqueCode() method.
    }

    public function cancelRental($uniqueCode, $adminUserId, $dateTime, $reason)
    {
        // TODO: Implement cancelRental() method.
    }
}