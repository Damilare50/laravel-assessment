<?php

    namespace App\Repository;

    use App\Models\Category;

    class CategoryRepository
    {
        public function findById(int $id, int $account_id): ?Category
        {
            return Category::where('id', $id)
                ->where('account_id', $account_id)
                ->first();
        }
    }
