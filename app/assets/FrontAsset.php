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
class FrontAsset extends AssetBundle
{
    public $basePath   = '@webroot';
    public $baseUrl    = '@web';
    // public $sourcePath = '@app/theme/pub';
    // public $sourcePath = '@web';
    public $css = [];
    public $js  = [

    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

    public function init(){

        // var_dump('yeahhhhhhhhhhhh');exit;

        // distinguimos las dependencias por entornos
        if(YII_ENV=='prod'){
            $this->js[]  = 'assets/dist/js/script.min.js';
            $this->css[] = 'assets/dist/css/styles.min.css';
        }else{
            $this->js[]  = 'assets/dist/js/scripts.js';
            $this->css[] = 'assets/dist/css/styles.min.css';
        }

    }

}
