<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;

class ProductDTO
{

    private $name;
    private $price;
    private $description;
    private $image;
    private $stocked;
    private $slug;

    public function __construct($request)
    {
        $this->name = $request['name'];
        $this->price = $request['price'] ?? 0;
        $this->description = $request['description'] ?? null;
        $this->image =  $request['image'] ?? null;
        $this->stocked = $request['stocked'] ?? false;
        $this->slug = $request['slug'] ?? null;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image,
            'stocked' => $this->stocked,
            'slug' => $this->slug,
        ];
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'name' => 'required',
            'price' => 'numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|file',
            'stocked' => 'nullable|boolean',
            'slug' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage(UploadedFile $file)
    {

        $image_name = time() . '.' . $file->extension();
        $image_dir = 'images/products';
        $image_path = public_path($image_dir);
        $file->move($image_path, $image_name);

        $this->image = $image_dir . '/' . $image_name;
    }

    public function getStocked()
    {
        return $this->stocked;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
