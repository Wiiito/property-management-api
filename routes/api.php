<?php

use App\Http\Controllers\OwnerController;
use App\Http\Middleware\OwnerValidation;
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

// Rotas sem middleware de autenticação -- Owner --
Route::post("/owner", [OwnerController::class, "store"]);
Route::get("/owner/{owner}", [OwnerController::class, "show"]);
Route::post("/owner/generateToken", [OwnerController::class, "generateToken"]);

// Rotas com middleware de autenticação -- Owner e ID na url -- 
// Fazndo com que a validação ocorra no OwnerController, pode-se validar um token
// de admin para ter acesso a todos os usuarios
Route::middleware(['auth:sanctum', OwnerValidation::class])->group(function () {
    Route::put("/owner/{owner}", [OwnerController::class, "update"]);
    Route::delete("/owner/{owner}", [OwnerController::class, "destroy"]);
});
