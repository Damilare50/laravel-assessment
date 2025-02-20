<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Product;
    use App\Models\Category;
    use App\Models\Account;
    use Faker\Factory as Faker;

    class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
            $faker = Faker::create();

            if (Category::count() == 0) {
                Category::insert([
                    ['name' => 'Electronics'],
                    ['name' => 'Fashion'],
                    ['name' => 'Home Appliances'],
                    ['name' => 'Books'],
                    ['name' => 'Sports'],
                ]);
            }


            if (Account::count() == 0) {
                Account::insert([
                    ['name' => 'Demo Account 1'],
                    ['name' => 'Demo Account 2'],
                    ['name' => 'Demo Account 3'],
                ]);
            }

            $categories = Category::pluck('id')->toArray();
            $accounts = Account::pluck('id')->toArray();

            foreach (range(1, 50) as $index) {
                Product::create([
                    'name' => $faker->word(),
                    'description' => $faker->sentence(),
                    'price' => $faker->randomFloat(2, 10, 500),
                    'stock_quantity' => $faker->numberBetween(1, 100),
                    'category_id' => $faker->randomElement($categories),
                    'account_id' => $faker->randomElement($accounts),
                ]);
            }
        }
    }
