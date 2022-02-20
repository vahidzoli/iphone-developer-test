<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;

class CommentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_comment_belongs_to_a_user()
    {
        $user = User::factory()->create(); 
        Comment::factory()->create(['user_id' => $user->id]);

        $this->assertTrue(true);
    }
}
