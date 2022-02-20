<?php
declare(strict_types=1);

namespace App\Achievements\Chains;

use Assada\Achievements\AchievementChain;
use Assada\Achievements\Model\AchievementProgress;
use App\Achievements\WatchLessons\UserWatchALesson;
use App\Achievements\WatchLessons\UserWatch5Lessons;
use App\Achievements\WatchLessons\UserWatch10Lessons;
use App\Achievements\WatchLessons\UserWatch25Lessons;
use App\Achievements\WatchLessons\UserWatch50Lessons;

/**
 * Class Registered
 *
 */
class TrackLessons extends AchievementChain
{
    /*
     * Returns a list of instances of Achievements
     */
    public function chain(): array
    {
        return [
            new UserWatchALesson(), new UserWatch5Lessons(), new UserWatch10Lessons(),
            new UserWatch25Lessons(), new UserWatch50Lessons()
        ];
    }

    /**
     * For an Achiever, return the next achievement on the chain that is locked.
     * @param $achiever
     * @return null|AchievementProgress
     */
    public function nextOnChain($achiever): ?AchievementProgress
    {
        $nextLocked = null;        
        foreach ($this->chain() as $instance) {
            if (is_null($achiever->achievementStatus($instance)->unlocked_at)) {
                return $achiever->achievementStatus($instance);
            }
        }
        return $nextLocked;
    }
}
