<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::get();
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
        $category_dto = new CategoryDTO($request->all());
        if ($validate = $category_dto->validate()) {
            return $validate;
        }

        $category = Category::create($category_dto->toArray());

        return response()->json([
            'message' => 'Категория успешно добавлена',
            'data' => $category
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category_dto = new CategoryDTO($request->all());
        if ($validate = $category_dto->validate()) {
            return $validate;
        }

        $category->name = $category_dto->getName();
        $category->parent_id = $category_dto->getParentId();

        $category->save();

        return response()->json([
            'message' => 'Категория обновлена',
            'data' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Категория удалена'
        ], 200);
    }
}
