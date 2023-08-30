<?php

namespace backend\dto;

class PurchaseDTO
{
    public int $userId;
    public int $productId;
    public function __construct(
        int $userId,
        int $productId,
    )
    {
        $this->userId = $userId;
        $this->productId = $productId;
    }
}