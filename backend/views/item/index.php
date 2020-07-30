<?php

use yii\grid\GridView;
use backend\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;



/* @var $this \yii\web\View  */
/* @var $model \backend\models\User*/
/* @var $dataProvider \backend\models\UserSearch */

$this->title =  'Item Management';
?>

<div class="container-fluid">
      <br>
      <br>
      <div class="row">
        <div class="col-md-1"></div>
         <div class="col-md-12">
            <div class ="card">
               <div class="card-body">
                <h3 class="custom-card-title"><?= $this->title ?></h3>
            <?= Html::a('<i class="fa fa-plus-circle"></i>'.' '. 'Create', ['create'],
                ['class' => 'btn btn-info d-none d-lg-block m-l-15 pull-right']) ?>
          
                <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'item_name',
                    'price',
                    [
                        'attribute'=>'item_status',
                        'filter'=> array("1"=>"Active","0"=>"Inactive"),
                        'filterInputOptions' => ['prompt' =>'All'],
                        'format' => 'raw',
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'value' => function ($data) {
                            return '<input type="checkbox" '.($data->item_status == 1 ? 'checked' : '').' data-toggle="toggle" class="status" data-on="Ready" data-off="Not Ready" data-onstyle="primary" data-offstyle="danger" value="0">';
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
</div>


<script type="text/javascript">

  function test($url)
  {
    console.log($url);
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
              location.href = '<?= Url::to(['delete'])?>/'+$url;
            } else {
              swal("Your imaginary file is safe!");
            }
          });
        return false;
  }

  $(document).ready(function(){
  $('.status').change(function () {
    $this = $(this);
    var value = 0;
    if($(this).prop("checked") == true){
        value = 1;
    }
    $.ajax({
        url: '<?= Url::to(['status'])?>',
        data: {id: $this.closest('tr').attr('data-key'), status: value},
        success: function (json) {
            toastr.success(json.msg, 'Success', {timeOut: 3000})
        }
    });       
 });
});

</script>



   



