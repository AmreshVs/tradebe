<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

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
                  <h4 class="card-title"><?= $model->getIsNewRecord() ? 'Create City' : 'Update City' ?></h4>
                  <hr>
               <?php $form = ActiveForm::begin(['id' => 'category-form']); ?>
                  <div class="row p-lg-2">
                     <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'city_name')->textInput() ?>
                        </div>
                     </div>
                     <div class ="col-md-6">
                       
                         <div class="form-group ">
                           <label>Status</label>
                            <?=$form->field($model, 'city_status')->checkbox([
                              'data-toggle' => 'toggle',
                              'data-on' => "Ready", 
                              'data-off' => "Not Ready",
                              'data-onstyle' => "primary",
                              'data-offstyle' => "danger"
                            ])->label(false) ?>
                     </div>
                  </div>

                  <div class= "col-md-12 text-center">
                     <?= Html::a('Cancel', Url::to(['/city']), ['class' => 'btn btn-secondary']); ?>
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


<style type="text/css">
 
</style>
