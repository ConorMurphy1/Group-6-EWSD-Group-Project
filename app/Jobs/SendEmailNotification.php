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
        Log::info('Sending email notification for comment "'.$this->comment->comment.'" to user "'.$this->user->full_name.'" for idea "'.$this->idea->title.'"');

        $coordinators = $this->user->departmentCoordinators;
        
        $ccEmails = $coordinators->pluck('email')->toArray();
        $ccNames = $coordinators->pluck('full_name')->toArray();

        // Log::info($ccEmails);
        // Log::info($ccNames);

        $postOwner = $this->user->full_name;
        $postTitle = $this->idea->title;

        /**
         * title - name of the idea
         * name - name of the user who created the idea 
         * comment - the comment
         */
        Mail::send('emails.notify', [
            'title' => $this->idea->title,
            'name' => $postOwner,
            'comment' => $this->comment->comment,
        ], function($mail) use ($ccEmails, $ccNames, $postOwner, $postTitle) {
            $mail->from('g6.university@myuni.ac.uk', 'University Mgmt System');
            $mail->to($this->user->email, $postOwner)
                ->cc($ccEmails, $ccNames)
                ->subject('New comment posted on '.$postTitle);
        });
    }
}

