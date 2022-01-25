<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SiteLayout extends Component
{
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title ?? 'Welcome Page';
    }

    public function render()
    {
        return view('components.site-layout');
    }
}
