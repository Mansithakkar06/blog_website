<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItems extends Component
{
    public $title;
    public $icon;
    public $url;
    public $path;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $icon, $url,$path)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->url = $url;
        $this->path=$path;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.menu-items');
    }
}
