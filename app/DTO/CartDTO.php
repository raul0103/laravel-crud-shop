<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;

class CartDTO
{

    private $quantity;

    public function __construct($request)
    {
        $this->quantity = $request['quantity'] ?? 0;
    }

    public function toArray()
    {
        return [
            'quantity' => $this->quantity,
        ];
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
