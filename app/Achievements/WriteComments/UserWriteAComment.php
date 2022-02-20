<?php
declare(strict_types=1);

namespace App\Achievements\WriteComments;

use Assada\Achievements\Achievement;
use Illuminate\Support\Facades\Log;
use App\Events\AchievementCompleted;

/**
 * Class Registered
 *
 */
class UserWriteAComment extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'UserWriteAComment';

    /*
     * A small description for the achievement
     */
    public $description = 'Congratulations! You write your first comment!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 1;

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
