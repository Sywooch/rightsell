<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $images = [
        'images/image1.jpg',
    ];
    public $css = [
        //'css/site.css',
        'css/scroll.css',
        'css/responsive.css',
        'css/responsive-tabs.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600',
    ];
    public $js = [
        //'js/jquery-1.10.2.min.js',
        //'js/bootstrap.js',
        'js/responsiveTabs.js',
        'js/jquery.mousewheel.js',
        'js/jquery.jscrollpane.min.js',
        'js/propertysearch.js',
        'js/jquery-ui.js',
        'js/demo.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        "only" => [
            "css/*",
            "js/*",
        ],
        'except' => [
            "doc/",
            "*.less",
        ],
    ];
}
