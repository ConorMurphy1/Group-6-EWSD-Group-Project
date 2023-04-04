<?php

namespace App\Jobs;

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

class SendCoordinatorsEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $idea;
    protected $user;
    protected $coordinators;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Idea $idea, User $user, mixed $coordinators)
    {
        $this->idea = $idea;
        $this->user = $user;
        $this->coordinators = $coordinators;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Email sent to department heads');

        $ccEmails = $this->coordinators->pluck('email')->toArray();
        $ccNames = $this->coordinators->pluck('full_name')->toArray();

        $coordinator = $this->coordinators->first();

        Mail::send('emails.notify', [
            'idea' => $this->idea,
            'user' => $this->user,
            'coordinator' => $coordinator,
        ], function($mail) use ($ccEmails, $ccNames, $coordinator) {
            $mail->from('g6.university@myuni.ac.uk', 'University Mgmt System');
            $mail->to($coordinator->email, $coordinator->full_name)
                ->cc($ccEmails, $ccNames)
                ->subject('An idea has posted from your department');
        });
    }
}
