<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\City;



?>


<main>
   <div class="container-fluid">
      <br>
      <br>
      <div class="row">
         <div class="col-md-2"></div>
         <div class="col-md-8">
            <div class ="card">
               <div class="card-body">
                  <h4 class="card-title"><?= $model->getIsNewRecord() ? 'Create Seller' : 'Update Seller' ?></h4>
                  <hr>

               <?php $form = ActiveForm::begin(['id' => 'vendor-form']); ?>
               <div class="col-md-6">
                        <?php if(!$model->getIsNewRecord()){ ?>
                        <img src="<?= $model->vendor_image_path ?>" alt="image" class="img-thumbnail">
                     <?php } ?>
                        <?= $form->field($modelUploadFrom, 'file')->fileInput() ?>
                  </div>
                  <div class="row p-lg-2">
                     <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'vendor_name')->textInput() ?>
                        </div>
                     </div>
                  </div>
                  <div class="row p-lg-2">
                     <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'vendor_desc')->textArea() ?>
                        </div>
                     </div>
                  </div>
                   <div class="row p-lg-2">
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
                  <div class="row p-lg-2">
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
                  <div class="row p-lg-2">
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
                   <div class="row p-lg-2">
                     <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'vendor_address')->textArea() ?>
                        </div>
                     </div>
                  </div>
                   <div class="row p-lg-2">
                     <div class="col-md-6">
                        <div class="form-group">
                              <?= $form->field($modelCity, 'city_id[]')->dropDownList(City::get(), ['class' => 'select2 form-control required', 'multiple' => true, 'required' => true]); ?>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group ">
                           <label>Status</label>
                            <?=$form->field($model, 'vendor_status')->checkbox([
                              'data-toggle' => 'toggle',
                              'data-on' => "Ready", 
                              'data-off' => "Not Ready",
                              'data-onstyle' => "primary",
                              'data-offstyle' => "danger"
                            ])->label(false) ?>
                        </div>
                     </div>
                  </div>
                  <div class= "col-md-12 text-center">
                     <?= Html::a('Cancel', Url::to(['/vendor']), ['class' => 'btn btn-secondary']); ?>
                     <?= Html::submitButton('Save',
            ['class' => 'btn btn-success']) ?>
                  </div>
                       <?php ActiveForm::end(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>

</main>


<script type="text/javascript">
  $(".select2").select2();
  <?php if(!$model->getIsNewRecord()){ ?>
      $('#vendorcity-city_id').val(['<?= $modelCityArr['city_id'] ?>']).trigger("change"); 
  <?php } ?>
</script>
