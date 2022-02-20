<?php
declare(strict_types=1);

namespace App\Achievements\WatchLessons;

use Assada\Achievements\Achievement;
use Illuminate\Support\Facades\Log;
use App\Events\AchievementCompleted;

/**
 * Class Registered
 *
 */
class UserWatch5Lessons extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'UserWatch5Lessons';

    /*
     * A small description for the achievement
     */
    public $description = 'Congratulations! You have watch 5 lessons!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 5;

    /*
     * Triggers whenever an Achiever unlocks this achievement
     */
    public function whenUnlocked($progress)
    {
        $achievement_name = $progress->details->name;
        $user = $progress->achiever;

        Log::info([$achievement_name, $user]);

        AchievementCompleted::dispatch($user);
    }
}
