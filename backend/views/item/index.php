<?php

/* @var $this \yii\web\View  */
/* @var $model \backend\models\User*/
/* @var $dataProvider \backend\models\UserSearch */

use yii\grid\GridView;
use backend\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

$model = new Item;

$name = 'Item';
$baseUrl = Url::to(['/item']);
$modalSize = 'modal-lg';
$this->title = 'Items';
?>

<div class="container-fluid">
  <h2 class="mt-2 mb-3"><?=$this->title?></h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
           <a href="<?= Url::to(['create']) ?>">
          <button id="create" class="btn btn-primary pull-right mb-2">
            <em class="fa fa-plus-circle"></em>
            Create
          </button>
        </a>
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'class' => 'table',
            'columns' => [
              'item_name',
              'price',
              [
                'attribute'=>'item_status',
                'filter'=> array("1"=>"Active","0"=>"Inactive"),
                'filterInputOptions' => ['prompt' =>'All', 'class' => 'form-control'],
                'format' => 'raw',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                  return '
                    <label class="switch sm mb-0">
                      <input type="checkbox" class="status" id="item-item_status" name="Item[item_status]" '.($data->item_status == 1 ? 'checked' : '').'>
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

<script type="text/javascript">

  $(document).on('click', '.btn-add', function(e) {
    e.preventDefault();
    fvrhtmlclone = $(".fvrduplicate").html();
    $(fvrhtmlclone).appendTo(".fvrclone").hide().fadeIn(300);
    $(this).removeClass('btn-add').addClass('btn-remove')
      .removeClass('btn-success').addClass('btn-danger')
      .html('<span class="fa fa-minus"></span> Remove');
  }).on('click', '.btn-remove', function(e) {
    e.preventDefault();
    $(this).parent().parent().fadeOut(300, function(){ 
      $(this).remove();
    });
  });


  $(document).on('change', '#item-main_category_id', function() {
    $("#item-category_id").html('<option value="">Loading...</option>');
    $.ajax({
      type: "POST",
      url: '<?=Url::to(['get-main-category'])?>',
      data: {
        id: $(this).val()
      },
      success: function(result) {
        $("#item-category_id").html('<option value="">Please Select Option</option>');
        $.each(result.data, function(idx, obj) {
          $("#item-category_id").append('<option value="' + idx + '">' + obj + '</option>');
        });
        $('#item-category_id').trigger('change');
      }
    });
  });

  $(document).on('change', '#item-category_id', function() {
    $("#item-sub_category_id").html('<option value="">Loading...</option>');
    $.ajax({
      type: "POST",
      url: '<?= Url::to(['get-sub-category'])?>',
      data: {
        id: $(this).val()
      },
      success: function(result) {
        $("#item-sub_category_id").html('<option value="">Please Select Option</option>');
        $.each(result.data, function(idx, obj) {
          $("#item-sub_category_id").append('<option value="' + idx + '">' + obj + '</option>');
        });
        $('#item-sub_category_id').trigger('change');
      }
    });
  });
// $('.select2').select2();
</script>