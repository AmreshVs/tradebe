<?php 
use yii\helpers\Url;
?>

<div id="side-layout" class="shadow-sm">
  <div class="sb-sidenav-menu">
    <div class="nav-side">
      <a class="nav-link text-muted" href="<?= Url::to(['/home/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Home
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/order/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Orders
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/banner/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Banners
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/city/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Cities
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/main-category/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Main Categories
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/category/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Categories
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/sub-category/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Sub Categories
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/vendor/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Sellers
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/item/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Items
      </a>
      <a class="nav-link text-muted" href="<?= Url::to(['/user/']); ?>">
        <div class="sb-nav-link-icon"><em class="fas fa-tachometer-alt"></em></div>
        Users
      </a>
    </div>
  </div>
</div>