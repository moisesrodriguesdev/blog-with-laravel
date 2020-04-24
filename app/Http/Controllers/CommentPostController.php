<?php

namespace App\Http\Controllers;

use App\CommentsPost;
use Illuminate\Http\Request;

class CommentPostController extends Controller
{
    private $post;
    private $comments;

    public function __construct(CommentsPost $comment)
    {
        $this->comments = $comment;
    }
    public function store(Request $request)
    {        
        try {
            $commentInstance = $this->comments->fill( $request->post() );
            $commentInstance->save();
    
            return response()->json([
                'message' => 'Comentário salvo com sucesso',
                'docs' => [
                    'comment' => $commentInstance->toArray()
                ]
            ], 200);
        } catch (Exception $e) {
           dd($e->getMessage());
        }

    }
}
