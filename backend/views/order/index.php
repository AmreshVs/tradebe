<?php

/* @var $this \yii\web\View  */
/* @var $model \backend\models\User*/
/* @var $dataProvider \backend\models\UserSearch */

use yii\grid\GridView;
use backend\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use backend\models\Order;

$model = new Order;

$name = 'Order';
$baseUrl = Url::to(['/order']);

?>
<div class="container-fluid">
  <h2 class="mt-2 mb-3">Orders</h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <button id="create" class="btn btn-primary pull-right mb-2" data-toggle="modal" data-target="#OrderModal">
            <em class="fa fa-plus-circle"></em>
            Create
          </button>
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                'order_number',
                'vendor_name',
                'item_name',
                'city_name',
                'created_at',     
              ],
            ]) ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include(Yii::$app->basePath . '/views/common/modal.php');
?>