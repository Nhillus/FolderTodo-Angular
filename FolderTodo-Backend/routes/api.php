<?php

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user', function (Request $request){
    return response() -> json(['success'=>true,]);
});

/*--------------- Rutas TodoList----------------------------*/
Route::get('/todos','TodoController@index');
Route::post('/agregartodo', 'TodoController@store');
Route::put('/modificartodo', 'TodoController@update');
Route::delete('/eliminartodo/{id}', 'TodoController@destroy');
Route::put('/modificartodoestado', 'TodoController@UpdateStatus');
Route::put('/agregartodoafolder', 'TodoController@addTodoToFolder');
Route::get('/todossingrupo', 'TodoController@getWithoutGroup');
/*--------------- Rutas FolderTodo ----------------------------*/
Route::get('/folders','FolderController@index');
Route::post('/agregarfolder', 'FolderController@store');
Route::put('/modificarfolder', 'FolderController@update');
Route::delete('/eliminarfolder/{id}', 'FolderController@destroy');
Route::get('/cargartodos/{id}', 'FolderController@load');






