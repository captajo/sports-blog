<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        return view('pages.dashboard.posts');
    }

    public function create()
    {
        return view('pages.dashboard.manage-post');
    }

}
