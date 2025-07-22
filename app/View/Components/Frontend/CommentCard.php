<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $userimage, $username, $description, $id, $createdAt, $postid;
    public function __construct($userimage, $username, $description, $id, $createdAt, $postid)
    {
        $this->username = $username;
        $this->userimage = $userimage;
        $this->description = $description;
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->postid = $postid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.comment-card');
    }
}
