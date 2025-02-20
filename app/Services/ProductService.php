<?php

    namespace App\Services;

    use App\Repository\CategoryRepository;
    use App\Repository\ProductRepository;
    use Illuminate\Http\JsonResponse;

    class ProductService
    {
        public function __construct(
            protected ProductRepository $productRepository,
            protected CategoryRepository $categoryRepository
        ) {}

        public function createProduct(int $account_id, array $data): JsonResponse
        {
            $_product = $this->productRepository->findByName($data['name'], $account_id);
            if ($_product) {
                return response()->json([
                    'success' => false,
                    'message' => 'product already exists',
                    'data' => null
                ], 400);
            }

            $category = $this->categoryRepository->findById($data['category_id'], $account_id);
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'category not found',
                    'data' => null
                ], 400);
            }

            $product = $this->productRepository->create(array_merge($data, ['account_id' => $account_id]));
            return response()->json([
                'success' => true,
                'message' => 'product created',
                'data' => $product
            ]);
        }

        public function list(array $filters): JsonResponse
        {
            return response()->json([
                'success' => true,
                'message' => 'product listed successfully',
                'data' => $this->productRepository->find($filters)
            ]);
        }

        public function updateProduct(int $id, array $data): JsonResponse
        {
            $product = $this->productRepository->findById($id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'product not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'product updated successfully',
                'data' => $this->productRepository->update($product, $data)
            ]);
        }

        public function fetchOne(int $id): JsonResponse
        {
            $product = $this->productRepository->findById($id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'product not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'product found',
                'data' => $product
            ]);
        }

        public function delete(int $id): JsonResponse
        {
            $product = $this->productRepository->findById($id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'product not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'product deleted successfully',
                'data' => $this->productRepository->delete($product),
            ]);
        }
    }
