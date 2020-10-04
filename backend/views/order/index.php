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
                [
                'class' => \yii\grid\ActionColumn::className(),
                'header' => 'Actions',
                'template' => '{view}',
                'buttons' => [
                  'view' => function ($url, $model, $key) {
                    $html = Html::tag('span', '', ['class' => 'fa fa-eye']);
                    return  Html::a($html . ' View', $url, [
                      'class' => 'btn btn-sm btn-secondary view-btn',
                     
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
<style type="text/css">


/*Invoice*/
.invoice .top-left {
    font-size:65px;
  color:#3ba0ff;
}

.invoice .top-right {
  text-align:right;
  padding-right:20px;
}

.invoice .table-row {
  margin-left:-15px;
  margin-right:-15px;
  margin-top:25px;
}

.invoice .payment-info {
  font-weight:500;
}

.invoice .table-row .table>thead {
  border-top:1px solid #ddd;
}

.invoice .table-row .table>thead>tr>th {
  border-bottom:none;
}

.invoice .table>tbody>tr>td {
  padding:8px 20px;
}

.invoice .invoice-total {
  margin-right:-10px;
  font-size:16px;
}

.invoice .last-row {
  border-bottom:1px solid #ddd;
}

.invoice-ribbon {
  width:85px;
  height:88px;
  overflow:hidden;
  position:absolute;
  top:-1px;
  right:14px;
}

.ribbon-inner {
  text-align:center;
  -webkit-transform:rotate(45deg);
  -moz-transform:rotate(45deg);
  -ms-transform:rotate(45deg);
  -o-transform:rotate(45deg);
  position:relative;
  padding:7px 0;
  left:-5px;
  top:11px;
  width:120px;
  background-color:#66c591;
  font-size:15px;
  color:#fff;
}

.ribbon-inner:before,.ribbon-inner:after {
  content:"";
  position:absolute;
}

.ribbon-inner:before {
  left:0;
}

.ribbon-inner:after {
  right:0;
}

@media(max-width:575px) {
  .invoice .top-left,.invoice .top-right,.invoice .payment-details {
    text-align:center;
  }

  .invoice .from,.invoice .to,.invoice .payment-details {
    float:none;
    width:100%;
    text-align:center;
    margin-bottom:25px;
  }

  .invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
    font-size:22px;
  }

  .invoice .btn {
    margin-top:10px;
  }
}

@media print {
  .invoice {
    width:900px;
    height:800px;
  }
}

</style>

<button type="button" class="btn btn-primary" style="display: none;" id="view" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
   
      
    </div>
  </div>
</div>




<script type="text/javascript">
     $('.view-btn').click(function(){
     // $("#item-sub_category_id").empty();
       $.ajax({
            type: "GET",
            url: '<?= Url::to(['view']) ?>',
            data: {id : $(this).closest('tr').attr('data-key') },
            success: function(result) {
                $('.modal-content').html(result);
                $('#view').click();
                 //$("#item-sub_category_id").trigger('liszt:updated');
                
            }
        });
            return false;
    });

</script>