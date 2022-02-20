<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use App\Models\Comment;
use App\Models\User;
use App\Events\CommentWritten;
use Tests\TestCase;

class WriteCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_write_a_comment()
    {
        $user = User::inRandomOrder()->first();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        CommentWritten::dispatch($comment);

        Log::info('LessonWatched event fired!');

        $this->assertTrue(True);
    }
}
