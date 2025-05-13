<?php

namespace App\Services;

use App\Exceptions\ErrorException;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function create($data, $file)
    {
        $url = Storage::disk('s3')->put('images', $file);
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'imageUrl' => $url,
            'stock' => $data['stock'],
        ]);

        return $product;
    }

    public function getProducts()
    {
        return ProductResource::collection(Product::all());
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new ErrorException('Product not found', 404);
        }

        return new ProductResource($product);
    }

    public function updateProduct($id, $data, $file)
    {
        $product = $this->findById($id);
        if ($file) {
            if ($product->imageUrl && Storage::disk('s3')->exists($product->imageUrl)) {
                Storage::disk('s3')->delete($product->imageUrl);
            }

            $url = Storage::disk('s3')->put('images', $file);
            $product->imageUrl = $url;
        }
        $product->update($data);

        return true;
    }

    public function deleteProduct($id)
    {
        $product = $this->findById($id);
        if (Storage::disk('s3')->exists($product->imageUrl)) {
            Storage::disk('s3')->delete($product->imageUrl);
        }
        $product->delete();

        return true;
    }

    private function findById($id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new ErrorException('Product not found', 404);
        }

        return $product;
    }
}
