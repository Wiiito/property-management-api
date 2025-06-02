<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyStatisticsController;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Middleware\PropertyMiddleware;
use App\Models\PropertyStatistics;
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

Route::get("/owner", [OwnerController::class, "index"])->name("owner.all");
Route::get("/owner/{owner}", [OwnerController::class, "show"])->name("owner.get");

Route::post("/owner", [OwnerController::class, "store"])->name("owner.create");
Route::post("/owner/generateToken", [OwnerController::class, "generateToken"])->name("owner.token");

// Rotas com middleware de autenticação -- Owner e ID na url -- 

// Deve-se ser ou admin ou o dono da conta para deletar ou atualizar
Route::middleware(['auth:sanctum', OwnerMiddleware::class])->group(function () {
    // -- Owner --
    Route::put("/owner/{owner}", [OwnerController::class, "update"])->name("owner.update");
    Route::delete("/owner/{owner}", [OwnerController::class, "destroy"])->name("owner.delete");
});

// ---- Properties statistics ----

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get("/property/statistics", [PropertyStatisticsController::class, "index"])->name("property.statistics.all");

    Route::get("/property/statistics/{property}", [PropertyStatisticsController::class, "show"])->name("property.statistics.get")
        ->middleware(PropertyMiddleware::class);
});

// ---- Property ----

Route::get("/property", [PropertyController::class, "index"])->name("property.all");
Route::get("/property/{property}", [PropertyController::class, "show"])->name("property.get");

// Rotas com middleware de autenticação -- Owner -- 
// Adicionando "user" ao request, deve estar logado para criar uma propriedade
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post("/property", [PropertyController::class, "store"])->name("property.create");
});

// Deve estar logado e ser dono do imovel para remover ou atualizar
Route::middleware(['auth:sanctum', PropertyMiddleware::class])->group(function () {
    Route::put("/property/{property}", [PropertyController::class, "update"])->name("property.update");
    Route::delete("/property/{property}", [PropertyController::class, "destroy"])->name("property.delete");
});
