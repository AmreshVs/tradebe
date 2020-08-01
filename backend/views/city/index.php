<?php

use yii\grid\GridView;
use backend\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

use backend\models\City;

$model = new City;
?>

<div class="container-fluid">
  <h2 class="mt-2 mb-3">Cities</h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <button class="btn btn-primary pull-right mb-2" data-toggle="modal" data-target="#createCityModal">
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
                      <input type="checkbox" id="city-city_status" name="City[city_status]" '.($data->city_status == 1 ? 'checked' : '').'>
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
                    $html = Html::tag('span', '', ['class' => 'fas fa-edit']);
                    return  Html::a($html . ' Edit', $url, [
                      'class' => 'btn btn-sm btn-secondary',
                    ]);
                  },
                  'delete' => function ($url, $model, $key) {
                    '<br>';
                    $html = Html::tag('span', '', ['class' => 'fas fa-trash']);
                    return Html::a($html . ' Delete', 'javascript:void(0)', [ 
                      'class' => 'ml-2 btn btn-sm btn-danger',
                      'data-pjax' => '0',
                      'onclick' => 'test('.$model->getPrimarykey().')',
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

<!-- Modal -->
<div class="modal fade" id="createCityModal" tabindex="-1" role="dialog" aria-labelledby="createCityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCityModalLabel"><?= $model->getIsNewRecord() ? 'Create City' : 'Update City' ?></h5>
        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include(Yii::$app->basePath . '/views/city/form.php'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function test($url) {
  swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to revert!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Category has been deleted!", {
          icon: "success",
        });
        location.href = '<?= Url::to(['delete'])?>/' + $url;
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  return false;
}

$(document).ready(function() {
  $('.status').change(function() {
    $this = $(this);
    var value = 0;
    if ($(this).prop("checked") == true) {
      value = 1;
    }
    $.ajax({
      url: '<?= Url::to(['status'])?>',
      data: {
        id: $this.closest('tr').attr('data-key'),
        status: value
      },
      success: function(json) {
        toastr.success(json.msg, 'Success', {
          timeOut: 3000
        })
      }
    });
  });
});

$('#save').on('click', function(){
  let form = $('#category-form');
  let url = form.attr('action');

  $.ajax({
    url: url,
    method: 'POST',
    data: form.serialize(),
    success: function({ status, msg}){
      if(status === 200){
        location.reload();
      }
    }
  })
});

</script>