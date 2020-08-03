<?php 
use yii\helpers\Url;
?>

<div id="side-layout" class="shadow-sm">
  <div class="sb-sidenav-menu">
    <div class="nav-side">
      <a class="nav-link text-muted" href="<?= Url::to(['/home/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-home"></em></div>
        Home
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/order/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-box-open"></em></div>
        Orders
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/banner/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-boxes"></em></div>
        Banners
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/city/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-city"></em></div>
        Cities
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/main-category/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-th-list"></em></div>
        Main Categories
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/category/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-layer-group"></em></div>
        Categories
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/sub-category/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-columns"></em></div>
        Sub Categories
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/vendor/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-user-check"></em></div>
        Sellers
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/item/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-boxes"></em></div>
        Items
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/user/']); ?>">
        <div class="sb-nav-link-icon"><em class="fa fa-users"></em></div>
        Users
      </a>
    </div>
  </div>
</div>