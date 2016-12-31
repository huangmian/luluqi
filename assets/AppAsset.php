<?php
namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $baseUrl = '@web';
    public $basePath = '@webroot';
    public $jsOptions = ['position'=>\yii\web\View::POS_END];
    public $depends = ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'];
    public $css = [
        'css/site.css',
        'css/media.css',
    ];
    public $js = [
        'js/site.js',
    ];
    
    public static function addScript($view, $jsfile)
    {
        $view->registerJsFile($jsfile, [AppAsset::className(), "depends" => "app\assets\AppAsset"]);
    }
    
    public static function addCss($view, $cssfile)
    {
        $view->registerCssFile($cssfile, [AppAsset::className(), "depends" => "app\assets\AppAsset"]);
    }
}