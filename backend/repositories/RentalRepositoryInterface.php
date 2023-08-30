<?php

namespace backend\repositories;

interface RentalRepositoryInterface
{
    public function createRental($rental);
    public function updateRental($rental);
    public function deleteRental($rental);
    public function getRentalById($id);
    public function getAllRentalsByUserId($id);
    public function getAllRentalsByProductId($id);
    public function getAllRentals();
    public function addAdditionalTimeToRentalByUniqueCode($uniqueCode, $additionalTime);
    public function cancelRentalByUniqueCode($uniqueCode);
    public function cancelRental($uniqueCode, $adminUserId, $dateTime, $reason);

}