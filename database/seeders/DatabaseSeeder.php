<?php

    namespace Database\Seeders;

    use App\Models\Account;
    use App\Models\Category;
    use App\Models\Product;
    use Faker\Factory as Faker;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
            $faker = Faker::create();

            $accounts = [];
            foreach (range(1, 3) as $i) {
                $accounts[] = Account::create([
                    'name' => "Seed Account $i",
                    'email' => $faker->email,
                    'password' => Hash::make('password')
                ]);
            }

            foreach ($accounts as $account) {
                $categories = [];
                foreach (['Electronics', 'Fashion', 'Home Appliances', 'Books', 'Sports'] as $name) {
                    $categories[] = Category::create([
                        'name' => $name,
                        'account_id' => $account->id,
                    ]);
                }

                // Create Products for Each Category
                foreach ($categories as $category) {
                    foreach (range(1, 10) as $index) {
                        Product::create([
                            'name' => $faker->word(),
                            'description' => $faker->sentence(),
                            'price' => $faker->randomFloat(2, 10, 500),
                            'stock_quantity' => $faker->numberBetween(1, 100),
                            'category_id' => $category->id,
                            'account_id' => $account->id,
                        ]);
                    }
                }
            }
        }
    }
