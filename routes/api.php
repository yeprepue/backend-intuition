<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{id}', [QuestionController::class, 'show']);
Route::post('/questions', [QuestionController::class, 'store']);
Route::put('/questions/{id}', [QuestionController::class, 'update']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);


Route::get('/user', [AuthController::class,'index']);
Route::get('/user/{id}', [AuthController::class,'show']);
Route::post('/user', [AuthController::class, 'store']);
Route::put('/user/{id}', [AuthController::class, 'update']);


Route::get('/usersanswers', [AnswerController::class,'index']);
Route::get('/usersanswers/{id}', [AnswerController::class,'show']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/refresh', [AuthController::class,'refresh']);

});

