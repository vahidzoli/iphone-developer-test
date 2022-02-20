<?php
declare(strict_types=1);

namespace App\Achievements\Chains;

use Assada\Achievements\AchievementChain;
use Assada\Achievements\Model\AchievementDetails;
use Assada\Achievements\Model\AchievementProgress;
use App\Achievements\Badges\Intermediate;
use App\Achievements\Badges\Advanced;
use App\Achievements\Badges\Master;

/**
 * Class Registered
 *
 * @package App\Achievements
 */
class TrackBadges extends AchievementChain
{
    /*
     * Returns a list of instances of Achievements
     */
    public function chain(): array
    {
        return [
            new Intermediate(), new Advanced(), new Master()
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

    /**
     * For an Achiever, return the current badge.
     * @param $achiever
     * @return null|AchievementProgress
     */
    public function currentBadge($achiever): ?AchievementProgress
    {
        $current = null;        
        foreach ($this->chain() as $instance) {
            if ($achiever->hasUnlocked($instance)) {
                $current = $achiever->achievementStatus($instance);
            } else {
                return $current;
            }
        }
        return $current;
    }

    public function remainingToNextBadge($achiever): int
    {
        $current = $achiever->achievements()->whereNotNull('unlocked_at')->count();

        $next = $this->nextOnChain($achiever);
        $next = AchievementDetails::where('id', $next->achievement_id)->first();

        return abs($next->points - $current);
    }
}
