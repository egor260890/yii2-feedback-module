<?php
namespace egor260890\feedback;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.05.2018
 * Time: 15:20
 */

use egor260890\feedback\assets\Assets;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'egor260890\feedback\controllers';
    
    public $defaultRoute='feedback';

    public function init()
    {
        \Yii::configure($this, require __DIR__ . '/config.php');
        Assets::register(\Yii::$app->getView(),\yii\web\View::POS_END);
        parent::init();
    }

}