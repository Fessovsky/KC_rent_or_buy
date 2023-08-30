<?php

namespace backend\repositories;


use backend\dto\PurchaseDTO;
use backend\models\Product;
use backend\models\Purchase;
use yii\web\ConflictHttpException;

class PurchaseRepository implements PurchaseRepositoryInterface
{

    public function makePurchase(PurchaseDTO $purchaseDTO)
    {

    }


    public function getPurchaseById($id)
    {
        // TODO: Implement getPurchaseById() method.
    }

    public function getAllPurchases()
    {
        // TODO: Implement getAllPurchases() method.
    }

    public function getAllPurchasesByUserId($id)
    {
        // TODO: Implement getAllPurchasesByUserId() method.
    }

    public function getAllPurchasesByProductId($id)
    {
        // TODO: Implement getAllPurchasesByProductId() method.
    }

    public function updatePurchase($purchase)
    {
        // TODO: Implement updatePurchase() method.
    }

    public function deletePurchase($purchase)
    {
        // TODO: Implement deletePurchase() method.
    }

    public function cancelPurchaseRequest($uniqueCode)
    {
        // TODO: Implement cancelPurchaseRequest() method.
    }

    public function cancelPurchase($uniqueCode, $adminUserId, $dateTime, $reason)
    {
        // TODO: Implement cancelPurchase() method.
    }

    public function checkAvailability($productId)
    {
        $product = Product::findOne($productId);
        if(!$product){
            throw new ConflictHttpException('Product does not exist.');
        }
        if($product->status === 1){
            throw new ConflictHttpException('Product is currently in rental.');
        }
        $isSold = Purchase::findOne(['product_id' => $productId]);
        if($isSold){
            throw new ConflictHttpException('Product is already sold.');
        }
        return true;
    }
}