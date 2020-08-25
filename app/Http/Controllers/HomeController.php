<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products_new = Product::orderBy('created_at', 'asc')
            ->take(4)
            ->get();
        $products_hot = Product::where('hot', 1)
            ->take(4)
            ->get();

        return view('home')->with([
            'slides' => Slider::all(),
            'categories' => Category::all(),
            'products_new' => $products_new,
            'products_hot' => $products_hot,
            'news' => News::all()
        ]);
    }
}
