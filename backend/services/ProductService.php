<?php

namespace backend\services;

use backend\dto\ProductDTO;
use backend\models\Product;
use backend\repositories\ProductRepository;
use yii\web\BadRequestHttpException;
use yii\web\ConflictHttpException;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(ProductDTO $productDTO)
    {
        $productDTO->name = ucfirst($productDTO->name);
        if (empty(trim($productDTO->name))) {
            throw new BadRequestHttpException('Product name cannot be empty.');
        }
        if (Product::find()->where(['name' => $productDTO->name])->exists()) {
            throw new ConflictHttpException('Product with the same name already exists.');
        }
        if ($productDTO->price <= 0) {
            throw new BadRequestHttpException('Product price cannot be 0 or less');
        }
        // TODO: Think about how to validate image, description
        return $this->productRepository->createProduct($productDTO);
    }
}