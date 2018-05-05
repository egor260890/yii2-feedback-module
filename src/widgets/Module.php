<?php
namespace egor260890\feedback\widgets;
use egor260890\feedback\widgets\assets\Assets;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.05.2018
 * Time: 9:28
 */

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'egor260890\feedback\widgets\controllers';

    public $defaultRoute='send';

    public $observers='lsls';

}