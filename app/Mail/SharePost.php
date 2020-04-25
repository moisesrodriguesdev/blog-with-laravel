<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Post;

class SharePost extends Mailable
{
    use Queueable, SerializesModels;

    private $post;
    private $request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, Request $dataRequest)
    {
        $this->post = $post;
        $this->request = $dataRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->post->title);
        $this->to($this->request->email);
        $this->markdown('emails.sharedpost',
            [
                'post' => $this->post
            ]);
    }
}
