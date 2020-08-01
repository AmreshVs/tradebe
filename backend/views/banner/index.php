<?php

use yii\grid\GridView;
use backend\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use backend\models\Banner;
use backend\models\CategoryUploadForm;

$model = new Banner;
$modelForm = new CategoryUploadForm;
?>


<div class="container-fluid">
  <h3 class="mt-2 mb-3">Banners</h3>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <button class="btn btn-primary pull-right mb-2" data-toggle="modal" data-target="#createBannerModal">
            <em class="fa fa-plus-circle"></em>
            Create
          </button>
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
              'banner_name',
              [
                'attribute'=>'banner_status',
                'filter'=> array("1"=>"Active","0"=>"Inactive"),
                'filterInputOptions' => ['prompt' =>'All', 'class' => 'form-control'],
                'format' => 'raw',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($model) {
                  return '<input type="checkbox" '.($model->banner_status == 1 ? 'checked' : '').' data-toggle="toggle" class="status" data-on="Ready" data-off="Not Ready" data-onstyle="primary" data-offstyle="danger" value="0">';
                },
              ],
              [
                'class' => \yii\grid\ActionColumn::className(),
                'header' => 'Actions',
                'template' => '{update}{delete}',
                'buttons' => [
                  'update' => function ($url, $model, $key) {
                    $html = Html::tag('span', '', ['class' => 'fas fa-edit']);
                    return  Html::a($html, $url);
                  },
                  'delete' => function ($url, $model, $key) {
                    '<br>';
                    $html = Html::tag('span', '', ['class' => 'fas fa-trash']);
                    return Html::a($html, 'javascript:void(0)', [ 
                      'data-pjax' => '0',
                      'onclick' => 'test('.$model->getPrimarykey().')',
                      'data-method' => 'post'
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

<!-- Modal -->
<div class="modal fade" id="createBannerModal" tabindex="-1" role="dialog" aria-labelledby="createBannerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createBannerModalLabel"><?= $model->getIsNewRecord() ? 'Create Banner' : 'Update Banner' ?></h5>
        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include(Yii::$app->basePath . '/views/banner/form.php'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function test($url) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
          location.href = '<?= Url::to(['delete '])?>' + $url;
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
</script>