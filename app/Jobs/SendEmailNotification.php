<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;
    protected $user;
    protected $idea;

    /**
     * Create a new job instance.
     *
     * @param Comment $comment
     * @param User $user
     * @param Idea $idea
     * @return void
     */
    public function __construct(Comment $comment, User $user, Idea $idea)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->idea = $idea;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Sending email notification for comment '.$this->comment->id.' to user '.$this->user->id.' for idea '.$this->idea->id);
        Mail::send('emails.notify', [
            'comment' => $this->comment->comment,
            'user' => $this->user,
            'title' => $this->idea->title
        ], function($mail) {
            $mail->from('example@laravel.ac.uk', 'Laravel');
            $mail->to($this->user->email, $this->user->name)->subject('New comment on you idea post');
        });
    }
}
