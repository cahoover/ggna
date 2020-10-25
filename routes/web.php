<?php

Route::statamic('/', 'home', ['load' => '/documentation']);
Route::statamic('google-ads', 'google-ads.index', ['load' => '/google-ads/introduction']);
Route::statamic('search-results', 'search');
Route::statamic('screencasts', 'screencasts');
Route::statamic('blog', 'blog.index');
Route::statamic('knowledge-base', 'knowledge-base.index');
Route::permanentRedirect('collections-and-entries', 'collections');
Route::permanentRedirect('entries', 'collections#entries');

Route::redirect('fieldtypes/partial', '/blueprints#importing-fieldsets');
