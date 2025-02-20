<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\Category\CreateCategory;
    use App\Services\CategoryService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class CategoryController extends Controller
    {
        public function __construct(protected CategoryService $categoryService) {}

        public function create(CreateCategory $request): JsonResponse
        {
            $validated = $request->validated();
            $account = Auth::guard('api')->user();


            return $this->categoryService->create($validated, $account->id);
        }

        public function list(Request $request): JsonResponse
        {
            $account = Auth::guard('api')->user();

            return $this->categoryService->list($account->id);
        }
    }
