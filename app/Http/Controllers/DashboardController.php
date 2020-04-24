<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class DashboardController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(){
        $posts = $this->post->all();

        return view('dashboard.home', compact('posts'));
    }
}
