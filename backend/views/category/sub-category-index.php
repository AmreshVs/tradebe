<?php

use yii\grid\GridView;
use backend\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;



/* @var $this \yii\web\View  */
/* @var $model \backend\models\User*/
/* @var $dataProvider \backend\models\UserSearch */

$this->title =  'Category Management';
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
                ['class' => 'btn btn-success btn-lg float-right']) ?>
          
                <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'category_name',
                    'parent_category',
                    [
                        'attribute'=>'category_status',
                        'format' => 'raw',
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'value' => function ($data) {
                            return '<input type="checkbox" checked data-toggle="toggle" data-width="100">';
                        },
                    ],

                    [
                            'class' => \yii\grid\ActionColumn::className(),
                            'header' => 'Actions',
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    $html = Html::tag('span', '', ['class' => 'fa fa-pencil text-inverse m-r-10']);
                                    return  Html::a($html, $url);
                                },
                                'delete' => function ($url, $model, $key) {
                                    $html = Html::tag('span', '', ['class' => 'fa fa-trash-o']);
                                    return Html::a($html, $url, [ 
                                        'data-pjax' => '0',
                                        'data-confirm' => 'Are you sure you want to delete this item?',
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

</script>



    </div>
</div>


   
<script type="text/javascript">    
runOnLoad(function () {
    var $this;
    $("[data-size = mini]").on('switchChange.bootstrapSwitch', function () {
        $this = $(this);
        var url_val = '<?= Url::to(['change-status']) ?>';
        Core.ajax({
            url: url_val,
            data: {key: $this.closest('tr').attr('data-key'), status: Core.checkboxBoolToInt($this.is(':checked'))},
            done: function (json) {
                if (parseInt(json.status) === 1) {
                    Core.success(json.msg);
                    return;
                }

                $this.attr('checked', !$this.is(':checked'));                     
            }
        });
    });

    $("[data-size = mini]").bootstrapSwitch();
    $('.select2').select2();

    $('body').on('click', '.quick-view', function () {
        $this = $(this);
        Core.ajax({
            url  : '<?= Url::to(['user/quick-view']) ?>',
            data : { id : $this.closest('tr').attr('data-key')},
            done : function (json) {
                if ( parseInt(json.status) === 1 ) {
                    $('#printpreview .modal-body').html(json.data);
                    return;
                }

                Core.handleInvalidServerResponse(json);
            }
        });
    });
})
</script>


