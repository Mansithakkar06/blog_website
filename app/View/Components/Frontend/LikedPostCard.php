<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LikedPostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $slug, $title, $image;
    public function __construct($slug, $title, $image)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.liked-post-card');
    }
}
