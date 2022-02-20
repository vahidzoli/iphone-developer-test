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
class Intermediate extends Achievement
{
    /*
     * The achievement name
     */
    public $name = 'Intermediate';

    /*
     * A small description for the achievement
     */
    public $description = 'Congratulations! You got Intermediate badge!';

    /*
     * The amount of "points" this user need to obtain in order to complete this achievement
     */
    public $points = 4;

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
