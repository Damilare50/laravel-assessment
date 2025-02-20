<?php

    namespace App\Repository;

    use App\Models\Account;

    class AccountRepository
    {

        public function create(array $data): Account
        {
            return Account::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        }

        public function findByEmail(string $email): ?Account
        {
            return Account::where('email', $email)->first();
        }
    }
