<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 19/09/2016
 * Time: 12:41
 */


namespace frontend\assets;

use yii\web\AssetBundle;

class LocateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/googleaddresslookup.js',
        'js/viewappointment.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}