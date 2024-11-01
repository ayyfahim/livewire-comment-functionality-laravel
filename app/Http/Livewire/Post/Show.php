<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class Show extends Component
{
    public $post;
    public $comments;
    public $all_comments_count;

    public $name;
    public $email;
    public $website;
    public $comment;
    public $reply;
    public $replyingTo;

    protected $rules = [
        'name' => 'string|required|min:5',
        'email' => 'email:rfc,dns|required',
        'website' => 'string|nullable',
        'comment' => 'string|required|min:3|max:5000',
        'reply' => 'integer|nullable',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comments = $this->post->comments;
        $this->all_comments_count = $this->post->all_comments->count();
        $this->replyingTo = null;
    }

    public function render()
    {
        return view('livewire.post.show');
    }

    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        $comment = new Comment;

        $comment->name = $this->name;
        $comment->email = $this->email;
        $comment->website = $this->website;
        $comment->comment = $this->comment;
        $comment->parent_id = $this->reply;

        $this->post->comments()->save($comment);

        $this->reset(['name', 'email', 'website', 'comment', 'reply']);

        $post = Post::find($this->post->id);
        $this->comments = $post->comments;
        $this->all_comments_count = $post->all_comments->count();
    }

    public function addReply($commentId)
    {
        $comment = Comment::find($commentId);
        if (!$comment) {
            return null;
        }
        $this->replyingTo =  $comment->name;
        $this->reply = $comment->id;
    }

    public function removeReply()
    {
        $this->replyingTo =  '';
        $this->reply = '';
    }
}
