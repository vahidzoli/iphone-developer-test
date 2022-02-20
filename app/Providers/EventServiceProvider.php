<?php

namespace App\Providers;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementCompleted;
use App\Listeners\UserWatchedLesson;
use App\Listeners\UserWrittenComment;
use App\Listeners\UserCompletedAchievement;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            UserWrittenComment::class
        ],
        LessonWatched::class => [
            UserWatchedLesson::class
        ],
        AchievementCompleted::class => [
            UserCompletedAchievement::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
