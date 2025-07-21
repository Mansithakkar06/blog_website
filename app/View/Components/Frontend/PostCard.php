<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $image, $title, $description, $author, $time, $categories, $userimage, $slug;
    public function __construct($image, $title, $description, $author, $time, $categories, $userimage, $slug)
    {
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->time = $time;
        $this->categories = $categories;
        $this->userimage = $userimage;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.post-card');
    }
}
