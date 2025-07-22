<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public $image;
    public $title;
    public $subtitle;
    public $posttitle;
    public function __construct($image, $title, $subtitle, $posttitle)
    {
        $this->image = $image;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->posttitle = $posttitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.header');
    }
}
