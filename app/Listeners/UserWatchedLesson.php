<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Achievements\Chains\TrackLessons;

class UserWatchedLesson
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $lesson = $event->lesson;
        
        $user->watched()->attach($lesson, ['watched' => True]);
        $user->addProgress(new TrackLessons(), 1);
    }
}
