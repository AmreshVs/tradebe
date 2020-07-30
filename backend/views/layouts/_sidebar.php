<?php 
use yii\helpers\Url;

$user = Yii::$app->getUser()->getIdentity();

?>

 <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Welcome</div>
                            <a class="nav-link" href="<?= Url::to(['/home/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/order/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Order Management
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/banner/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Banner Management
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/city/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                City Management
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/main-category/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Main Category Management
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/category/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Category Management
                            </a>
                             <a class="nav-link" href="<?= Url::to(['/sub-category/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Sub Category Management
                            </a>
                             <a class="nav-link" href="<?= Url::to(['/vendor/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Seller Management
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/item/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Item Management
                            </a>
                            <a class="nav-link" href="<?= Url::to(['/user/']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                User Management
                            </a>
                        
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= $user->first_name ?>
                    </div>
                </nav>
            </div>