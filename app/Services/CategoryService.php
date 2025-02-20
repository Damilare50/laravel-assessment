<?php

    namespace App\Services;

    use App\Repository\CategoryRepository;
    use Illuminate\Http\JsonResponse;

    class CategoryService
    {
        public function __construct(protected CategoryRepository $categoryRepository) {}

        public function create(array $data, int $account_id)
        {
            $_category = $this->categoryRepository->findByName($data['name'], $account_id);
            if ($_category) {
                return response()->json([
                    'success' => false,
                    'message' => 'category already exists',
                    'data' => $_category
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'category created',
                'data' => $this->categoryRepository->create($data)
            ]);
        }

        public function list(int $account_id): JsonResponse
        {
            return response()->json([
                'success' => true,
                'message' => 'category listed successfully',
                'data' => $this->categoryRepository->list($account_id),
            ]);
        }
    }
