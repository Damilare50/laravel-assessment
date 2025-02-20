<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class ForceJsonResponse
    {
        /**
         * Handle an incoming request.
         *
         * @param Closure(Request): (Response) $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            $request->headers->set('Accept', 'application/json');

            $response = $next($request);

            if (!$response instanceof JsonResponse) {
                return response()->json($response->getContent(), $response->getStatusCode());
            }

            return $response;
        }
    }
