<?php

namespace egor260890\feedback\helpers;


use egor260890\feedback\entities\Feedback;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class FeedbackHelper
{
    public static function statusList(): array
    {
        return [
            Feedback::STATUS_UNREVIEWED => 'Не просмотрен',
            Feedback::STATUS_VIEWED => 'Просмотрен',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Feedback::STATUS_UNREVIEWED:
                $class = 'label label-danger';
                break;
            case Feedback::STATUS_VIEWED:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

}
