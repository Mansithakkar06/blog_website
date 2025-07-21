<?php

namespace App\View\Components\Frontend;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = Auth::user();
        $categories = Category::whereStatus('active')->get();
        return view('components.frontend.navbar', compact('user', 'categories'));
    }
}
