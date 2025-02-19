<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
      <?= Html::encode($this->title) ?>
    </title>
    <?php 
      $this->registerCsrfMetaTags();
      $this->head();
    ?>
  </head>
  <body>
    <?php 
      $this->beginBody();
      echo $content;
      $this->endBody();
    ?>
  </body>
</html>
<?php $this->endPage(); ?>
