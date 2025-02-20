<?php

    use App\Http\Controllers\AccountController;
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
        return response()->json(['success' => true, 'message' => 'Welcome to the API!']);
    });

    Route::prefix('/account')->group(function () {
        Route::post('', [AccountController::class, 'register']);     // register
        Route::post('/login', [AccountController::class, 'login']);   // login
        Route::post('/logout', [AccountController::class, 'logout'])->middleware('jwt.auth'); // logout
    });

