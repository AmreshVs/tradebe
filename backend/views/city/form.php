<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin(['id' => 'category-form', 'action' => Yii::$app->request->url]); ?>



<div class="container-fluid">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
        
          <h3 class="mt-2 mb-3"><?= $model->getIsNewRecord() ? 'Create City' : 'Update City' ?></h3>

            <div class="form-group">
			  <?= $form->field($model, 'city_name')->textInput() ?>
			</div>
	
            <div class="form-group">
              <label class="w-100">Status</label>
              <label class="switch">
                <input type="checkbox" id="banner-city_status" name="Banner[city_status]" onclick="if($(this).prop('checked') == true) { $(this).val(1) } else {$(this).val(0) }"value="<?= $model->city_status == null ? 0 : $model->city_status ?>">
                <span class="slider round"></span>
              </label>
            </div>

             <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                          <em class="fa fa-times-circle"></em>
                          Close
                        </button>
                         <button type="submit" class="btn btn-primary" id="save">
                          <em class="fa fa-save"></em>
                          Submit
                        </button>
                     
                      
              </div>
              <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>