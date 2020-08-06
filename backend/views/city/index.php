<?php

use yii\grid\GridView;
use backend\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

use backend\models\City;

$model = new City;

$name = 'City';
$baseUrl = Url::to(['/city']);
$this->title = 'Cities';

?>

<div class="container-fluid">
  <h2 class="mt-2 mb-3"><?=$this->title?></h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <button id="create" class="btn btn-primary pull-right mb-2" data-toggle="modal" data-target="#CityModal">
            <em class="fa fa-plus-circle"></em>
            Create
          </button>
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'class' => 'table',
            'columns' => [
              'city_name',
              [
                'attribute'=>'city_status',
                'filter'=> array("1"=>"Active","0"=>"Inactive"),
                'filterInputOptions' => ['prompt' =>'All', 'class' => 'form-control'],
                'format' => 'raw',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                  return '
                    <label class="switch sm mb-0">
                      <input type="checkbox" class="status" id="city-city_status" name="City[city_status]" '.($data->city_status == 1 ? 'checked' : '').'>
                      <span class="slider round"></span>
                    </label>
                  ';
                },
              ],
              [
                'class' => \yii\grid\ActionColumn::className(),
                'header' => 'Actions',
                'template' => '{update}{delete}',
                'buttons' => [
                  'update' => function ($url, $model, $key) {
                    $html = Html::tag('span', '', ['class' => 'fa fa-edit']);
                    return  Html::a($html . ' Edit', $url, [
                      'class' => 'btn btn-sm btn-secondary edit-btn',
                      'data-toggle' => 'modal',
                      'data-target' => '#CityModal'
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
          ]); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include(Yii::$app->basePath . '/views/common/modal.php');
?>