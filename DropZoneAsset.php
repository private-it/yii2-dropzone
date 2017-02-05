<?php

namespace devgroup\dropzone;

use yii\web\AssetBundle;

class DropZoneAsset extends AssetBundle
{
    public $sourcePath = '@bower/dropzone/dist';
    public $css = [
        YII_DEBUG ? 'dropzone.css' : 'min/dropzone.min.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
    ];
    public $js = [
        YII_DEBUG ? 'dropzone.js' : 'min/dropzone.min.js',
    ];
}
