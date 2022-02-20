<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Achievements\Chains\TrackComments;
use App\Achievements\Chains\TrackBadges;
use App\Achievements\Chains\TrackLessons;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        if($user->unlockedAchievements()->count() > 0){
            $unlocked_achievements = $user->unlockedAchievements()->map(function ($item) {
                return $item->details->name;
            });
    
            $comment = new TrackComments();    
            $next_available_comment_achievements = $comment->nextOnChain($user);
    
            $lesson = new TrackLessons();    
            $next_available_lesson_achievements = $lesson->nextOnChain($user);

            $next_available_achievements = [
                $next_available_comment_achievements->details->name,
                $next_available_lesson_achievements->details->name
            ];
    
            $badge = new TrackBadges();
            $current_badge_achievements = $badge->currentBadge($user);
            $current_badge_achievements = $current_badge_achievements ? $current_badge_achievements->details->name: null;
            $next_available_badge_achievements = $badge->nextOnChain($user);
            $next_available_badge_achievements = $next_available_badge_achievements->details->name;
            $remaining_to_next_badge = $badge->remainingToNextBadge($user);
        } else {
            $unlocked_achievements = [];
            $next_available_achievements = [];
            $current_badge_achievements = 'Beginner';
            $next_available_badge_achievements = 'Intermediate';
            $remaining_to_next_badge = 4;
        }
        
        return response()->json([
            'unlocked_achievements' => $unlocked_achievements,
            'next_available_achievements' => $next_available_achievements,
            'current_badge' => $current_badge_achievements ?? 'Beginner',
            'next_badge' => $next_available_badge_achievements,
            'remaing_to_unlock_next_badge' => $remaining_to_next_badge
        ]);
    }
}
