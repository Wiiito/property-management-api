<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Middleware\PropertyMiddleware;
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

// Rotas sem middleware de autenticação 

// ---- Owner ----

Route::post("/owner", [OwnerController::class, "store"]);
Route::get("/owner/{owner}", [OwnerController::class, "show"]);
Route::post("/owner/generateToken", [OwnerController::class, "generateToken"]);

// Rotas com middleware de autenticação -- Owner e ID na url -- 

// Deve-se ser ou admin ou o dono da conta para deletar ou atualizar
Route::middleware(['auth:sanctum', OwnerMiddleware::class])->group(function () {
    // -- Owner --
    Route::put("/owner/{owner}", [OwnerController::class, "update"]);
    Route::delete("/owner/{owner}", [OwnerController::class, "destroy"]);
});


// ---- Property ----

Route::get("/property", [PropertyController::class, "index"]);
Route::get("/property/{property}", [PropertyController::class, "show"]);

// Rotas com middleware de autenticação -- Owner -- 
// Adicionando "user" ao request, deve estar logado para criar uma propriedade
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post("/property", [PropertyController::class, "store"]);
});

// Deve estar logado e ser dono do imovel para remover ou atualizar
Route::middleware(['auth:sanctum', PropertyMiddleware::class])->group(function () {
    Route::put("/property/{property}", [PropertyController::class, "update"]);
    Route::delete("/property/{property}", [PropertyController::class, "destroy"]);
});
