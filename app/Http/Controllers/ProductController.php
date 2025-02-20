<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function create(CreateProduct $request): JsonResponse
    {
        $validated = $request->validated();
        $account = Auth::guard('api')->user();

        return $this->productService->createProduct($account->id, $validated);
    }

    public function list(Request $request): JsonResponse
    {
        return $this->productService->list($request->all());
    }

    public function fetchOne(Request $request, int $id): JsonResponse
    {
        return $this->productService->fetchOne($id);
    }

    public function update(UpdateProduct $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        return $this->productService->updateProduct($id, $validated);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        return $this->productService->delete($id);
    }
}
