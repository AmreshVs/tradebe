<?php

use yii\grid\GridView;
use backend\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;



/* @var $this \yii\web\View  */
/* @var $model \backend\models\User*/
/* @var $dataProvider \backend\models\UserSearch */

?>
<div class="container-fluid">
  <h2 class="mt-2 mb-3">Orders</h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <?= Html::a('<i class="fa fa-plus-circle"></i>'.' '. 'Create', ['create'], ['class' => 'btn btn-primary pull-right mb-2']) ?>
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
          location.href = '<?= Url::to(['delete '])?>/' + $url;
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
        url: '<?= Url::to(['status '])?>',
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