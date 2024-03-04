<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get("/", function () {
    return view("plantilla");
});

Route::get("/todos", function () {
    return view("contenido.index");
});



/*
Route::get("/", [CrudController::class, "index"])->name("crud.index");
//ruta para añadir un nuevo producto
Route::post("/registrar-producto", [CrudController::class, "create"])->name("crud.create");

//ruta para modificar producto
Route::post("/modificar-producto", [CrudController::class, "update"])->name("crud.update");

//ruta para eliminar producto
Route::get("/eliminar-producto-{id}", [CrudController::class, "delete"])->name("crud.delete");
*/