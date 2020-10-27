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

Route::statamic('/', 'home', ['load' => '/home']);
Route::statamic('google-ads', 'google-ads.index', ['load' => '/google-ads']);
Route::statamic('cookbook', 'cookbook.index', ['load' => '/cookbook']);
Route::statamic('blog', 'blog.index', ['load' => '/blog']);
Route::statamic('search-results', 'search');
// Route::permanentRedirect('collections-and-entries', 'collections');
// Route::permanentRedirect('entries', 'collections#entries');

// Route::redirect('fieldtypes/partial', '/blueprints#importing-fieldsets');
