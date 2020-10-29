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
                'url' => '/analytics',
                'active' => request()->segment(1) === 'analytics',
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
