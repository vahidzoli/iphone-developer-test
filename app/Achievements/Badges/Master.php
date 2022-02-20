<?php
declare(strict_types=1);

namespace App\Achievements\Badges;

use Assada\Achievements\Achievement;
use Illuminate\Support\Facades\Log;
use App\Events\AchievementCompleted;

/**
 * Class Registered
 *
 */
class Master extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'Master';

    /*
     * A small description for the achievement
     */
    public $description = 'Congratulations! You got Master badge!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 10;

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
