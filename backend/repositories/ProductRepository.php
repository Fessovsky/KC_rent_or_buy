<?php

namespace backend\repositories;

use backend\dto\ProductDTO;
use backend\models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function createProduct(ProductDTO $productDTO)
    {
        try {
            $product = new Product();
            $product->name = $productDTO->name;
            $product->description = $productDTO->description;
            $product->price = $productDTO->price;
            $product->image = $productDTO->image;
            if ($product->save()) {
                return [
                    'success' => true,
                    'message' => 'Product was created successfully',
                    'product' => $product
                ];
            }
            throw new \Exception('Product was not created', 500);
        } catch (\Exception $e) {
            return new \Exception($e->getMessage(), 500);
        }
    }

    public function updateProduct($product)
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteProduct($product)
    {
        // TODO: Implement deleteProduct() method.
    }

    public function getAllProducts()
    {
        // TODO: Implement getAllProducts() method.
    }

    public function getAvailableProducts()
    {
        // TODO: Implement getAvailableProducts() method.
    }

    public function getUnavailableProducts()
    {
        // TODO: Implement getUnavailableProducts() method.
    }

    public function getProductById($id)
    {
        // TODO: Implement getProductById() method.
    }

    public function getProductByName($name)
    {
        // TODO: Implement getProductByName() method.
    }

    public function getProductsByPriceRange($min, $max)
    {
        // TODO: Implement getProductsByPriceRange() method.
    }

    public function getProductsByUserId($id)
    {
        // TODO: Implement getProductsByUserId() method.
    }
}