<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Create a user test.
     *
     * @return void
     */
    public function test_create_a_user()
    {
        User::factory()->create();

        $this->assertTrue(true);
    }

    /**
     * User has many comments test.
     *
     * @return void
     */
    public function test_user_has_many_comment()
    {
        User::factory()
            ->has(Comment::factory()->count(2))
            ->create();

        $this->assertTrue(true);
    }

    /**
     * User lesson test.
     *
     * @return void
     */
    public function test_user_belongs_to_many_lessons()
    { 
        User::factory()
            ->hasAttached(
                Lesson::factory()->count(2),
                ['watched' => true]
            )
            ->create();
        
        $this->assertTrue(true);
    }
}
