<?php

namespace backend\repositories;

use backend\dto\PurchaseDTO;

interface PurchaseRepositoryInterface
{
    public function makePurchase(PurchaseDTO $purchaseDTO);
    public function checkAvailability($productId);
    public function getPurchaseById($id);
    public function getAllPurchases();

    public function getAllPurchasesByUserId($id);
    public function getAllPurchasesByProductId($id);
    public function updatePurchase($purchase);
    public function deletePurchase($purchase);
    public function cancelPurchaseRequest($uniqueCode);
    public function cancelPurchase($uniqueCode, $adminUserId, $dateTime, $reason);
}