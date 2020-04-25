<?php

namespace App\Http\Controllers;

use App\Post;
use App\CommentsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Exception;
use Cache;
use App\Mail\SharePost;


class PostController extends Controller
{
    private $post;
    private $comments;

    public function __construct(Post $post, CommentsPost $comment)
    {
        $this->post = $post;
        $this->comments = $comment;
    }
    public function index()
    {
        $posts = $this->post->all();
        return view('post.home', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }


    public function store(Request $request)
    {

        $dataValidated = $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'imagem' => 'required|file'
        ]);


        $postInstance = $this->post->fill( $request->all() );
        $postInstance->save();


        $file = $request->file('imagem');

        $fileOriginalName = $file->getClientOriginalName();

        $fileStoraged = Storage::putFileAs("public/post/{$postInstance->id}", $file, $fileOriginalName);

        if ($fileStoraged) {
            $postInstance->update(['imagem' => $fileOriginalName]);
            return redirect()->route('post.home')->with(['type' => 'success', 'message' => 'Post salvo com sucesso' ]);
        } else {
            return redirect()->route('post.create')->with(['type' => 'danger', 'message' => 'Não foi possivel salvar o post' ]);
        }


    }

    public function show(Post $post)
    {
        if(Cache::has($post->id) == false){
            Cache::add($post->id, 'contador', 0.50);

            $amountViewsPost = $post->views;
            $ViewsUpdate = $amountViewsPost + 1;

            $post->update(['views' => $ViewsUpdate]);
        }

        $comments = $this->comments->where('post_id', '=', $post->id)->orderBy('created_at')->get();

        return view('post.view', compact('post', 'comments'));

    }

    public function PostLike(Request $request)
    {
        try {
            $postInstance = $this->post->findOrFail($request->post_id);

            $amountLikesPost = $postInstance->likes;
            $likeUpdate = $amountLikesPost + 1;

            $postInstance->update(['likes' => $likeUpdate]);

            return response()->json([
                'message' => 'Você curtiu',
                'type' => 'success'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel curtir o post',
                'type' => 'danger'
            ], 500);
        }
    }

    public function SharePost(Request $request, Post $post)
    {

        try {
            Mail::send(new SharePost($post, $request));
            return redirect()->route('post.home')->with(['type' => 'success', 'message' => 'Post compartilhado com sucesso' ]);
        }
        catch (Exception $e){
            return redirect()->route('post.create')->with(['type' => 'danger', 'message' => 'Não foi compartilhar o post']);
        }
    }

}
