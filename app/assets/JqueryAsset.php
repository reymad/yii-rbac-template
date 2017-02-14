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
class jQueryAsset extends AssetBundle
{

    public $sourcePath = '@app/theme/pub/jquery';
    public $css = [];
    public $js  = [
        'jquery.browser.js',
        'jquery.blockUI.js',
    ];
    public $depends = [

    ];

    public function init(){

    }

}
