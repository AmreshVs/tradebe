<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.ś
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    '/backend/web/css/style.css',
    '/backend/web/css/bootstrap/bootstrap-4.5.0.min.css'
  ];
  public $js = [
    // '/backend/web/js/jquery/jquery-3.5.1.min.js',
  ];
  public $depends = [
    // 'yii\web\YiiAsset',
    // 'yii\bootstrap\BootstrapAsset',
  ];
}