<?php
namespace egor260890\feedback\listeners;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.05.2018
 * Time: 9:20
 */
use egor260890\feedback\entities\FeedbackInterface;

interface FeedbackObserverInterface
{
    static function getInstance():FeedbackObserverInterface ;

    function update(FeedbackInterface $feedback);

}