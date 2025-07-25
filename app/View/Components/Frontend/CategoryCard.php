<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $image, $name, $slug;
    public function __construct($image, $name, $slug)
    {
        $this->image = $image;
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.category-card');
    }
}
