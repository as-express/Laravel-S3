<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProduct;
use App\Services\ProductService;
use App\Exceptions\ErrorException;
use App\Http\Requests\UpdateProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $ProductService;

    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }

    public function store(CreateProduct $request)
    {
        try {
            $data = $request->validated();
            $file = $request->file('image');
            $result = $this->ProductService->create($data, $file);

            return response()->json($result);
        } catch (ErrorException $err) {
            return $err->throw($request);
        }
    }

    public function getAll()
    {
        $result = $this->ProductService->getProducts();
        return response()->json($result, 200);
    }

    public function getOne(Request $request, $id)
    {
        try {
            $product = $this->ProductService->getProduct($id);
            return response()->json($product, 200);
        } catch (ErrorException $err) {
            return $err->throw($request);
        }
    }

    public function update(UpdateProduct $request, $id)
    {
        try {
            $data = $request->validated();
            $file = $request->file('image');
            $result = $this->ProductService->updateProduct($id, $data, $file);

            return response()->json($result, 200);
        } catch (ErrorException $err) {
            return $err->throw($request);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $result = $this->ProductService->deleteProduct($id);
            return response()->json($result, 200);
        } catch (ErrorException $err) {
            return $err->throw($request);
        }
    }
}
