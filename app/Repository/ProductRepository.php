<?php

    namespace App\Repository;

    use App\Models\Product;
    use Illuminate\Pagination\LengthAwarePaginator;

    class ProductRepository
    {
        public function find(array $filters, $limit = 10): LengthAwarePaginator
        {
            $query = Product::query();

            if (!empty($filters['category_id'])) {
                $query->where('category_id', $filters['category_id']);
            }


            if (!empty($filters['min_price'])) {
                $query->where('price', '>=', $filters['min_price']);
            }

            if (!empty($filters['max_price'])) {
                $query->where('price', '<=', $filters['max_price']);
            }

            return $query->paginate($limit);
        }

        public function findById(int $id): ?Product
        {
            return Product::where('id', $id)->first();
        }

        public function findByName(string $name, int $account_id): ?Product
        {
            return Product::where('name', $name)
                ->where('account_id', $account_id)
                ->first();
        }

        public function create(array $data): Product
        {
            return Product::create($data);
        }

        public function update(Product $product, array $data): Product
        {
            $product->fill($data);
            $product->save();

            return $product->refresh();
        }

        public function delete(Product $product): bool
        {
            return $product->delete();
        }
    }
