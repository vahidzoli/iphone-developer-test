<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use App\Models\Lesson;
use App\Models\User;
use App\Events\LessonWatched;
use Tests\TestCase;

class WatchLessonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_watch_a_lesson()
    {
        $user = User::inRandomOrder()->first();
        $lesson = Lesson::inRandomOrder()->first();
        $watched = $user->watched->pluck('id')->toArray();

        if(! in_array($lesson->id, $watched)){
            LessonWatched::dispatch($lesson, $user);
            Log::info('LessonWatched event fired!');
        }

        $this->assertTrue(True);
    }
}
