<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Symfony\Component\HttpFoundation\Response;
    use Tymon\JWTAuth\Exceptions\JWTException;

    class AuthMiddleware
    {
        /**
         * Handle an incoming request.
         *
         * @param Closure(Request): (Response) $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            try {
                $account = Auth::guard('api')->user();
                if (!$account) {
                    return response()->json([
                        'success' => false,
                        'message' => 'unauthenticated'
                    ], Response::HTTP_UNAUTHORIZED);
                }

            } catch (JWTException $e) {
                return response()->json(['error' => 'Token not valid'], 401);
            }

            return $next($request);
        }
    }
