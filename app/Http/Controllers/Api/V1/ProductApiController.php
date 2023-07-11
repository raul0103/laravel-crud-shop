<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\ProductDTO;
use App\DTO\ProductSearchDTO;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_dto = new ProductDTO($request->all());
        if ($validate = $product_dto->validate()) {
            return $validate;
        }

        // Обработка изображения, если оно было загружено
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $product_dto->setImage($file);
        }

        // Если слаг не передан создать его из названия
        if (!$product_dto->getSlug()) {
            $product_dto->setSlug(Str::slug($product_dto->getName()));
        }

        $product = Product::create($product_dto->toArray());

        return response()->json([
            'message' => 'Товар успешно добавлен',
            'data' => $product
        ], 200);
    }

    public function search(Request $request)
    {
        $product_search_dto = new ProductSearchDTO($request->all());

        $query = Product::query();

        if ($product_search_dto->getName()) {
            $query->where('name', 'LIKE', '%' . $product_search_dto->getName() . '%');
        }

        if ($product_search_dto->getPrice()) {
            $query->where('price', $product_search_dto->getPrice());
        }

        if ($product_search_dto->getStocked()) {
            $query->where('stocked', $product_search_dto->getStocked());
        }

        return $query->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product_dto = new ProductDTO($request->all());
        if ($validate = $product_dto->validate()) {
            return $validate;
        }

        // Обработка изображения, если оно было загружено
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $product_dto->setImage($file);
        }

        $product->name = $product_dto->getName();
        $product->price = $product_dto->getPrice();
        $product->description = $product_dto->getDescription();
        $product->image = $product_dto->getImage();
        $product->slug = $product_dto->getSlug() ?? $product->slug;
        $product->save();

        return response()->json([
            'message' => 'Товар успешно обновлен',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Товар успешно удален'
        ], 200);
    }
}
