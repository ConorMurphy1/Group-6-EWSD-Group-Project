<?php

namespace App\Listeners;

use App\Events\IdeaUploaded;
use App\Jobs\SendCoordinatorsEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendIdeaUploadedNotification 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\IdeaUpload  $event
     * @return void
     */
    public function handle(IdeaUploaded $event)
    {
        Log::info('listener is called handle');

        $idea = $event->idea;
        $user = $idea->user;
        
        /** get department coordinators */
        $coordinators = $user->departmentCoordinators;

        SendCoordinatorsEmailNotification::dispatch($idea, $user, $coordinators);        
    }
}
