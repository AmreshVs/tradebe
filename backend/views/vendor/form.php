<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\City;

?>

    <?php $form = ActiveForm::begin(['id' => 'vendor-form']); ?>



<div class="container-fluid">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
        
          <h3 class="mt-2 mb-3"><?= $model->getIsNewRecord() ? 'Create Seller' : 'Update Seller' ?></h3>

            <div class="form-group">
      <label>Image</label>
      <?php if(!$model->getIsNewRecord()){ ?>
      <img src="<?= $model->vendor_image_path ?>" alt="..." width="500" height="200" class="img-thumbnai" />
      <?php } else{ ?>
        <img src="" id="selected-img" class="img-fluid mb-2 rounded d-none" alt="thumbnail" />
      <?php } ?>
      <div class="form-control p-1">
        <?= $form->field($modelUploadFrom, 'file')->fileInput()->label(false); ?>
      </div>
    </div>
    <div class="form-group">
      <?= $form->field($model, 'vendor_name')->textInput() ?>
    </div>
    <div class="form-group">
      <?= $form->field($model, 'vendor_desc')->textArea() ?>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($model, 'first_name')->textInput() ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($model, 'last_name')->textInput() ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($model, 'email')->textInput() ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($model, 'mobile')->textInput() ?>
        </div>
      </div>
    </div>
    <?php if($model->getIsNewRecord()) { ?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($model, 'password')->passwordInput(['required' => true]) ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($model, 'confirm_password')->passwordInput(['required' => true]) ?>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="form-group">
      <?= $form->field($model, 'vendor_address')->textArea() ?>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <?= $form->field($modelCity, 'city_id[]')->dropDownList(City::get(), ['class' => 'select2 form-control required', '' => true, 'required' => true]); ?>
        </div>
      </div>

      <div class="col-md-6">
      <div class="form-group">
        <label class="w-100">Status</label>
        <label class="switch">
          <input type="checkbox" id="banner-vendor_status" name="Banner[vendor_status]" onclick="if($(this).prop('checked') == true) { $(this).val(1) } else {$(this).val(0) }" value="<?= $model->vendor_status == null ? 0 : $model->vendor_status ?>">
  
          <span class="slider round"></span>
        </label>
      </div>
      </div>
    </div>

             <div class="modal-footer">
                        <a href="<?=Url::to(['/vendor']) ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                          <em class="fa fa-times-circle"></em>
                          Back
                        </button>
                      </a>
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



<script src="/backend/web/js/common/imgToUrl.js"></script>
<script type="text/javascript">
  // $(".select2").select2(); 
  <?php
    if (!$model->getIsNewRecord()) {
  ?>
      $('#vendorcity-city_id').val(['<?=$modelCityArr['city_id']?>']).trigger("change"); 
  <?php
    } 
  ?>
</script>