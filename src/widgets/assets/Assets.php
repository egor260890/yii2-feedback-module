<?php
namespace egor260890\feedback\widgets\assets;

use yii\web\AssetBundle;

class Assets extends AssetBundle{
    public $sourcePath = '@egor260890/feedback/widgets/assets';

    public $js = [
        'js/send.js',
    ];

    public $css = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}