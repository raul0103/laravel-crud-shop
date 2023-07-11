<?php

namespace App\DTO;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryDTO
{

    private $name;
    private $parent_id;

    public function __construct($request)
    {
        $this->name = $request['name'] ?? null;
        $this->parent_id = $request['parent_id'] ?? null;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ];
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'name' => 'required',
            'parent_id' => 'nullable',
        ]);

        $validator->after(function ($validator) {
            $data = $validator->getData();

            if ($data['parent_id']) {
                $limit_childrens = 10;
                $category = Category::find($this->parent_id);
                if ($category->childrens()->count() == $limit_childrens) {
                    $validator->errors()->add('parent_id', 'Невозможно привязать новую категорию к категории с ID:' . $this->parent_id . '. У категории с ID:' . $this->parent_id . ' достигнут лимит дочерних подкатегорий (' . $limit_childrens . ')');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }
}
