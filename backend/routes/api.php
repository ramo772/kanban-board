<?php

use App\Http\Controllers\WebService\Api\MemberCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('cards')->group(function () {
    Route::get('/', [MemberCardController::class, 'index']);
    Route::post('/', [MemberCardController::class, 'store']);
    Route::put('/{id}', [MemberCardController::class, 'updateStatus']);
    Route::delete('/{id}', [MemberCardController::class, 'destroy']);
});
