<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database '];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'created_at' => $this->post->created_at,
        ];
    }
}
