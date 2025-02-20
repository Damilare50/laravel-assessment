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

        public function findByName(string $name, int $account_id): ?Category
        {
            return Category::where('name', $name)
                ->where('account_id', $account_id)
                ->first();
        }

        public function create(array $data): Category
        {
            return Category::create($data);
        }

        public function list(int $account_id): array
        {
            return Category::query()
                ->where('account_id', $account_id)
                ->get()
                ->toArray();
        }
    }
