<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.02.2018
 * Time: 14:25
 */

namespace egor260890\feedback\repositories;


use egor260890\feedback\entities\Feedback;
use egor260890\feedback\exceptions\NotFoundException;

class FeedbackRepository
{
    public function get($id): Feedback
    {
        if (!$feedback = Feedback::findOne($id)) {
            throw new NotFoundException('Feedback is not found.');
        }
        return $feedback;
    }

    public function save(Feedback $feedback)
    {
        if (!$feedback->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Feedback $feedback)
    {
        if (!$feedback->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}