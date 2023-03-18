<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $user;
    public $title;

    /**
     * Create a new message instance.
     *
     * @param string $comment Comment on the idea post
     * @param User $user User who commented
     * @param string $title The title of the idea post
     * @return void
     */
    public function __construct($comment, $user, $title)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->title = $title;
    }

    
    /**
     * Build method to generate an email message
     */
    public function build()
    {
        return $this->view('emails.notify', [
            'comment' => $this->comment,
            'user' => $this->user,
            'title' => $this->title
        ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Comment Notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
