<?php

    namespace App\Services;

    use App\Models\Account;
    use App\Repository\AccountRepository;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    class AccountService
    {
        public function __construct(protected AccountRepository $accountRepository) {}

        public function register(array $data): Account
        {
            return $this->accountRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }

        public function login(array $data): JsonResponse
        {
            if (!$token = Auth::guard('api')->attempt($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized'
                ], 401);
            }

            $account = Auth::guard('api')->user();

            return response()->json([
                'success' => true,
                'message' => 'logged in successfully',
                'data' => [
                    'account' => $account,
                    'token' => $token,
                ]
            ]);
        }

        public function logout()
        {
            return Auth::guard('api')->logout();
        }
    }
