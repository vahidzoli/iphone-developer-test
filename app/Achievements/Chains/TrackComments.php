<?php
declare(strict_types=1);

namespace App\Achievements\Chains;

use Assada\Achievements\AchievementChain;
use Assada\Achievements\Model\AchievementProgress;
use App\Achievements\WriteComments\UserWriteAComment;
use App\Achievements\WriteComments\UserWrite3Comments;
use App\Achievements\WriteComments\UserWrite5Comments;
use App\Achievements\WriteComments\UserWrite10Comments;
use App\Achievements\WriteComments\UserWrite20Comments;

/**
 * Class Registered
 *
 */
class TrackComments extends AchievementChain
{
    /*
     * Returns a list of instances of Achievements
     */
    public function chain(): array
    {
        return [
            new UserWriteAComment(), new UserWrite3Comments(), new UserWrite5Comments(),
            new UserWrite10Comments(), new UserWrite20Comments()
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
