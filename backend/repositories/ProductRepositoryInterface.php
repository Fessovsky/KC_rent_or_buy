<?php

namespace backend\repositories;

use backend\dto\ProductDTO;

interface ProductRepositoryInterface
{
    public function createProduct(ProductDTO $productDTO);
    public function updateProduct($product);
    public function deleteProduct($product);
    public function getAllProducts();
    public function getAvailableProducts();
    public function getUnavailableProducts();
    public function getProductById($id);
    public function getProductByName($name);
    public function getProductsByPriceRange($min, $max);
    public function getProductsByUserId($id);
}