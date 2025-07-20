<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.index');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function category($slug)
    {
        dd($slug);
        $category=Category::whereSlug($slug)->first();
        return view('frontend.category');
    }
}
