<?php

/* @var $this \yii\web\View  */
/* @var $model \backend\models\User*/
/* @var $dataProvider \backend\models\UserSearch */

use yii\grid\GridView;
use backend\models\Vendor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

$model = new Vendor;

$name = 'Seller';
$baseUrl = Url::to(['/vendor']);
$modalSize = "modal-lg";
$this->title =  'Sellers';

?>

<div class="container-fluid">
  <h2 class="mt-2 mb-3"><?=$this->title?></h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
            <a href="<?= Url::to(['create']) ?>">
          <button id="create" class="btn btn-primary pull-right mb-2" >
            <em class="fa fa-plus-circle"></em>
            Create
          </button>
        </a>
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
              'vendor_name',
              'first_name',
              'email',
              'mobile',
              [
                'attribute'=>'vendor_status',
                'filter'=> array("1"=>"Active","0"=>"Inactive"),
                'filterInputOptions' => ['prompt' =>'All', 'class' => 'form-control'],
                'headerOptions' => ['width' => '120'],
                'format' => 'raw',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                  return '
                    <label class="switch sm mb-0">
                      <input type="checkbox" class="status" id="vendorstatus-vendor_status" name="VendorStatus[vendor_status]" '.($data->vendor_status == 1 ? 'checked' : '').'>
                      <span class="slider round"></span>
                    </label>
                  ';
                },
              ],
              [
                'class' => \yii\grid\ActionColumn::className(),
                'header' => 'Actions',
                'headerOptions' => ['width' => '200'],
                'template' => '{update}{delete}',
                'buttons' => [
                  'update' => function ($url, $model, $key) {
                    $html = Html::tag('span', '', ['class' => 'fa fa-edit']);
                    return  Html::a($html . ' Edit', $url, [
                      'class' => 'btn btn-sm btn-secondary edit-btn',
     
                    ]);
                  },
                  'delete' => function ($url, $model, $key) {
                    $html = Html::tag('span', '', ['class' => 'fa fa-trash']);
                    return Html::a($html . ' Delete', 'javascript:void(0)', [ 
                      'class' => 'ml-2 btn btn-sm btn-danger',
                      'data-pjax' => '0',
                      'onclick' => 'deleteRow('.$model->getPrimarykey().')',
                      'data-method' => 'post',
                    ]);
                  },
                ],
              ],
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