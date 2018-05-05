<?php
/**
 * Date: 17.01.14
 * Time: 1:06
 */

namespace egor260890\feedback\assets;

use yii\web\AssetBundle;

class Assets extends AssetBundle{
	public $sourcePath = '@egor260890/feedback/assets';

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