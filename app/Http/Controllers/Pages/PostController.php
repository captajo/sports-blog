<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{  
    /**
     * My post page
     *
     * @return void
     */
    public function index()
    {
        return view('pages.dashboard.posts');
    }
    
    /**
     * Create/Edit Post Page
     *
     * @return void
     */
    public function create()
    {
        return view('pages.dashboard.manage-post');
    }

}
