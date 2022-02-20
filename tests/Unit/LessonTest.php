<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Lesson;
use App\Models\User;

class LessonTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_lesson_belongs_to_many_users()
    {
        $user = User::factory()->create(); 
        $lesson = Lesson::factory()->create();

        $user->watched()->attach($lesson, ['watched' => True]);
        
        $this->assertTrue(true); 
    }
}
