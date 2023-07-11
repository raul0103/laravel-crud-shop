<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;

class ProductSearchDTO
{

    private $name;
    private $price;
    private $stocked;

    public function __construct($request)
    {
        $this->name = $request['name'] ?? null;
        $this->price = $request['price'] ?? null;
        $this->stocked = $request['stocked'] ?? null;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'stocked' => $this->stocked,
        ];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStocked()
    {
        return $this->stocked;
    }
}
