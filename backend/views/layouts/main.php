<?php

/* @var $this \yii\web\View */
/* @var $content string */

  use backend\assets\AppAsset;
  use yii\helpers\Html;
  use yii\widgets\Breadcrumbs;

  AppAsset::register($this);
  $this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script src="/backend/web/js/jquery/jquery-3.5.1.min.js"></script>
    <script src="/backend/web/js/bootstrap/bootstrap-4.5.0.min.js"></script>
    <script src="/backend/web/js/bootstrap/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/backend/web/js/sweetalert/sweetalert.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <?php 
      $this->head();
      $this->registerCsrfMetaTags(); 
    ?>

    <title>
      <?= Html::encode($this->title) ?>
    </title>
  </head>
  <body class="sb-nav-fixed">
    <?php 
      $this->beginBody();
      $this->beginContent('@app/views/layouts/_header.php');
      $this->endContent();
    ?>

    <div id="sidenav">
      <?php 
        $this->beginContent('@app/views/layouts/_sidebar.php');
        $this->endContent();
      ?>
      <div id="sidenav_content">
        <?= $content ?>
      </div>
    </div>
    <?php $this->endBody()?>
    
    <script src="/backend/web/js/script.js"></script>
  </body>
</html>

<?php $this->endPage()?>