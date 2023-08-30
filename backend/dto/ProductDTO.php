<?php

namespace backend\dto;

class ProductDTO
{
    public string $name;
    public mixed $price;
    public string $description;
    public string $image;
    public int $status;
    public function __construct(
        string $name,
        mixed $price,
        string $description,
        string $image,
        int $status = 0
    )
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->status = $status ?? 0;
    }
}