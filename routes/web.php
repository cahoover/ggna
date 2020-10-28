<?php

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

Route::statamic('/', 'home', ['load' => '/pages/home']);
Route::statamic('google-ads', 'google-ads.index', ['load' => '/pages/google-ads']);
Route::statamic('cookbook', 'cookbook.index', ['load' => '/pages/cookbook']);
Route::statamic('blog', 'blog.index');
Route::statamic('search-results', 'search');
// Route::permanentRedirect('collections-and-entries', 'collections');
// Route::permanentRedirect('entries', 'collections#entries');

// Route::redirect('fieldtypes/partial', '/blueprints#importing-fieldsets');
