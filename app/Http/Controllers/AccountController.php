<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\Account\Login;
    use App\Http\Requests\Account\Register;
    use App\Services\AccountService;
    use Illuminate\Http\JsonResponse;

    class AccountController extends Controller
    {
        public function __construct(protected AccountService $accountService) {}

        public function register(Register $request): JsonResponse
        {
            $validated = $request->validated();

            $response = $this->accountService->register($validated);

            return response()->json([
                'success' => true,
                'message' => 'user created successfully',
                'data' => $response,
            ]);
        }

        public function login(Login $request): JsonResponse
        {
            $credentials = $request->only('email', 'password');

            return $this->accountService->login($credentials);
        }

        public function logout(): JsonResponse
        {
            try {
                $this->accountService->logout();

                return response()->json(['success' => true, 'message' => 'user logged out successfully', 'data' => null]);
            } catch (\Throwable $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage(), 'data' => null], 500);
            }
        }
    }
