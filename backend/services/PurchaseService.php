<?php

namespace backend\services;
use backend\repositories\PurchaseRepository;
use backend\models\Purchase;

class PurchaseService
{
    private $purchaseRepository;
    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function makePurchase($purchaseDTO)
    {
        if(!$this->purchaseRepository->checkAvailability($purchaseDTO->productId)){
            throw new \Exception('Product is not available', 500);
        }
        $purchase = new Purchase();
        $purchase->user_id = $purchaseDTO->userId;
        $purchase->product_id = $purchaseDTO->productId;
        $purchase->unique_code = uniqid();
        $purchase->purchase_date = date('Y-m-d H:i:s');
        if ($purchase->save()) {
            return [
                'success' => true,
                'message' => 'Purchase was created successfully',
                'purchase' => $purchase
            ];
        }
        throw new \Exception('Purchase was not created', 500);
    }
    public function updatePurchase($purchase)
    {}

    public function checkAvailability($productId)
    {
        $purchase = $this->purchaseRepository->checkAvailability($productId);
        if ($purchase) {
            return [
                'success' => true,
                'message' => 'Product is available',
            ];
        }
        throw new \Exception('Product is not available', 500);
    }

}