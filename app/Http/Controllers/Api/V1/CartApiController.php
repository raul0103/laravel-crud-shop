<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\CartDTO;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $user_id = auth()->user()->id;

        $cart_dto = new CartDTO($request->all());
        if ($cart_dto->getQuantity()) {
            // Создайте или обновите запись в корзине для авторизованного пользователя
            $cart_item = Cart::updateOrCreate(
                [
                    'user_id' => $user_id,
                    'product_id' => $product->id
                ],
                ['quantity' => $cart_dto->getQuantity()]
            );

            return response()->json(['message' => 'Товар добавлен в корзину', 'data' => $cart_item]);
        } else {
            $this->delete($product, $user_id);

            return response()->json(['message' => 'Товар удален из корзины']);
        }
    }


    public function delete(Product $product, $user_id = null)
    {
        if (!$user_id)
            $user_id = auth()->user()->id;

        $cart_item = Cart::where(
            [
                ['user_id', '=', $user_id],
                ['product_id', '=', $product->id]
            ],
        )->first();

        if ($cart_item)
            $cart_item->delete();

        return response()->json(['message' => 'Товар удален из корзины']);
    }
}
