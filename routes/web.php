<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthorizationMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
Route::prefix('user')->group(function () {
    Route::post('/insert', [AuthController::class, 'insert'])->middleware(AuthorizationMiddleware::class);
});
*/

Route::middleware([AuthorizationMiddleware::class])->group(function() {
    Route::post('insert', [AuthController::class, 'insert']);
    Route::get('list', [AuthController::class, 'list']);
    Route::delete('delete/{id}', [AuthController::class, 'delete']);

});
