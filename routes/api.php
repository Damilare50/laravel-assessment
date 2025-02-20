<?php

    use App\Http\Controllers\AccountController;
    use App\Http\Controllers\ProductController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/', function () {
//        return response()->json(['success' => true, 'message' => 'Welcome to the API!']);
        return \Illuminate\Support\Facades\Password::sendResetLink(['email' => 'damilarelamine@gmail.com']);
    });

    Route::prefix('/account')->group(function () {
        Route::post('', [AccountController::class, 'register']);     // register
        Route::post('/login', [AccountController::class, 'login']);   // login
        Route::post('/reset-password', [AccountController::class, 'resetPassword']);
        Route::post('/verify-password', [AccountController::class, 'verifyPassword']);
        Route::post('/logout', [AccountController::class, 'logout'])->middleware('jwt.auth'); // logout
    });

    Route::middleware('jwt.auth')->prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'list']);
        Route::post('/', [ProductController::class, 'create']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'delete']);
        Route::get('/{id}', [ProductController::class, 'fetchOne']);
    });
