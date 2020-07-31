<?php 
use yii\helpers\Url;

$user = Yii::$app->getUser()->getIdentity();
?>

<nav class="topnav navbar navbar-expand shadow-sm">
  <button class="btn btn-link order-1 order-lg-0" id="sidebarToggle" href="#">
    <em class="fas fa-bars"></em>
  </button>
  <a class="navbar-brand" href="index.html">India Mart</a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <div class="nav-link dropdown-toggle text-muted" id="userDropdown" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><em class="fas fa-user fa-fw"></em>
        <?= $user->first_name ?>
      </div>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="#">Activity Log</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= Url::to(['/login/logout']); ?>">Logout</a>
      </div>
    </li>
  </ul>
</nav>