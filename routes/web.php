<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [MaterialController::class, 'index']);
Route::get('/edit/{id}', [MaterialController::class, 'edit'])->name('editMaterial');
Route::get('/view/{id}', [MaterialController::class, 'view'])->name('viewMaterial');
Route::post('/search', [MaterialController::class, 'search'])->name('search');
Route::get('/create', [MaterialController::class, 'create'])->name('create');
Route::post('/create', [MaterialController::class, 'store'])->name('createMaterial');
Route::post('/update/{id}', [MaterialController::class, 'update'])->name('updateMaterial');
Route::get('/delete/{id}', [MaterialController::class, 'delete'])->name('deleteMaterial');

Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::get('/tags/edit/{id}', [TagController::class, 'edit'])->name('editTag');
Route::get('/tags/create', [TagController::class, 'create'])->name('createTag');
Route::post('/tags/create', [TagController::class, 'store'])->name('storeTag');
Route::get('/tags/delete/{id}', [TagController::class, 'delete'])->name('deleteTag');
Route::post('/tags/update/{id}', [TagController::class, 'update'])->name('updateTag');
Route::get('/deletetag/{id}', [TagController::class, 'deleteTagFromMaterial'])->name('deleteTagFromMaterial');
Route::post('/addtag/{id}', [TagController::class, 'addTagToMaterial'])->name('addTagToMaterial');
Route::get('/search-{id}', [TagController::class, 'searchByTag'])->name('searchByTag');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('createCategory');
Route::post('/categories/create', [CategoriesController::class, 'store'])->name('storeCategory');
Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('editCategory');
Route::get('/categories/delete/{id}', [CategoriesController::class, 'delete'])->name('deleteCategory');
Route::post('/categories/update/{id}', [CategoriesController::class, 'update'])->name('updateCategory');

Route::post('/addlink/{id}', [LinkController::class, 'addLink'])->name('addLink');
Route::get('/deletelink/{id}', [LinkController::class, 'deleteLink'])->name('deleteLink');
Route::get('/view/{id}/editlink-{title}', [LinkController::class, 'editLink'])->name('editLink');
Route::post('/updatelink/{id}', [LinkController::class, 'updateLink'])->name('updateLink');
