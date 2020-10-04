<?php
use yii\helpers\Url;
use backend\models\Item;


?>

<main>
  <div class="container-fluid">
    <h2 class="mt-2 mb-3">Home</h2>
    <div class="row">
      <div class="col-xl-3 col-md-6">
        <a class="no-decor" href="<?=Url::to(['/user/']);?>">
          <div class="card mb-4">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-xl-4">
                  <div class="round-container text-primary">
                    <em class="fa fa-users"></em>
                    <div class="round-icon bg-primary"></div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <h3 class="mb-0"><?= $userCount ?></h3>
                  <p class="mb-0 text-muted">Total Users</p>
                </div>
              </div>
            </div>
            <span class="dash-underline bg-primary"></span>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-md-6">
        <a class="no-decor" href="<?=Url::to(['/vendor/']);?>">
          <div class="card mb-4">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-xl-4">
                  <div class="round-container text-warning">
                    <em class="fa fa-users"></em>
                    <div class="round-icon bg-warning"></div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <h3 class="mb-0"><?= $sellerCount ?></h3>
                  <p class="mb-0 text-muted">Total Seller</p>
                </div>
              </div>
            </div>
            <span class="dash-underline bg-warning"></span>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-md-6">
        <a class="no-decor" href="<?=Url::to(['/vendor/']);?>">
          <div class="card mb-4">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-xl-4">
                  <div class="round-container text-success">
                    <em class="fa fa-users"></em>
                    <div class="round-icon bg-success"></div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <h3 class="mb-0"><?= $orderCount ?></h3>
                  <p class="mb-0 text-muted">Total Order</p>
                </div>
              </div>
            </div>
            <span class="dash-underline bg-success"></span>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-md-6">
        <a class="no-decor" href="<?=Url::to(['/vendor/']);?>">
          <div class="card mb-4">
            <div class="card-body p-4">
              <div class="row">
                <div class="col-xl-4">
                  <div class="round-container text-danger">
                    <em class="fa fa-users"></em>
                    <div class="round-icon bg-danger"></div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <h3 class="mb-0"><?= $cityCount ?></h3>
                  <p class="mb-0 text-muted">Total City</p>
                </div>
              </div>
            </div>
            <span class="dash-underline bg-danger"></span>
          </div>
        </a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <em class="fa fa-table mr-1"></em>
        Today Orders
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Item</th>
                <th>Unit</th>
                <th>Qty</th>
           
              </tr>
            </thead>

            <tbody>

            <?php foreach ($todayOrders as $key => $order) { ?>
            
              <tr>
                <td><?= $order['customer_name'] ?></td>
                <td><?= $order['mobile_number'] ?></td>
                <td><?= Item::getName($order['item_id']);?></td>
                <td><?= $order['unit'] ?></td>
                <td><?= $order['qty'] ?></td>
           
              </tr>
            <?php } ?>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>