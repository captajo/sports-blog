<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{  
    /**
     * Landing Page
     *
     * @return void
     */
    public function index()
    {
        return view('pages.home');
    }
    
    /**
     * Single Post Page
     *
     * @param  mixed $slug
     * @return void
     */
    public function show(string $slug)
    {
        return view('pages.single', ['slug' => $slug]);
    }

    
    /**
     * Category Page
     *
     * @param  mixed $slug
     * @return void
     */
    public function categories(string $id)
    {
        return view('pages.category', ['id' => $id]);
    }

    /**
     * Category Page
     *
     * @param  mixed $slug
     * @return void
     */
    public function search()
    {
        return view('pages.search');
    }
}
