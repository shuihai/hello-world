<?php

//namespace activity\assets;
//
//use yii\web\AssetBundle;
//
///**
// * Main frontend application asset bundle.
// */
//class AppAsset extends AssetBundle
//{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
//    public $css = [
//        'css/site.css',
//    ];
//    public $js = [
//    ];
//    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//    ];
//}
//<?php

namespace activity\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
 
        'css/index.css',
    ];
    public $js = [
//        'js/jq1.11.2.js',
//        'js/bootstrap.min.js',
//        'js/distpicker/distpicker.data.js',
//        'js/distpicker/distpicker.js',
//        'js/distpicker/main.js',
//		'js/index.js',
    ];
    public $depends = [
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile('@web' . $jsfile, [AppAsset2::className(), 'depends' => 'robotUser\assets\AppAsset', 'position' => \yii\web\View::POS_HEAD]);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile('@web' . $cssfile, [AppAsset2::className(), 'depends' => 'robotUser\assets\AppAsset', 'position' => \yii\web\View::POS_HEAD]);
    }

}
