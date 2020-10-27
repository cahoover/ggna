<?php

namespace App\Http\View\Composers;

class SideNavComposer
{
    public function compose($view)
    {
        $view->with('pages', [
            [
                'title' => 'Analytics',
                'icon' => 'book',
                'url' => '/',
                'active' => empty(request()->segments())
                    || ! in_array(request()->segment(1), ['google-ads', 'blog', 'cookbook']),
            ],
            [
                'title' => 'Google Ads',
                'icon' => 'tv',
                'url' => '/google-ads',
                'active' => request()->segment(1) === 'google-ads',
            ],
            [
                   'title' => 'Cookbook',
                   'icon' => 'cookbook',
                   'url' => '/cookbook',
                   'active' => request()->segment(1) === 'cookbook',
            ],
            [
                'title' => 'Blog',
                'icon' => 'tetris',
                'url' => '/blog',
                'active' => request()->segment(1) === 'blog',
            ],


        ]);
    }
}
