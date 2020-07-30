<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<main>
   <div class="container-fluid">
      <br>
      <br>
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10">
            <div class ="card">
               <div class="card-body">
                  <h4 class="card-title">Create User</h4>
                  <hr>
               <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
                  <div class="row p-lg-2">
                     <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'first_name')->textInput() ?>
                        </div>
                     </div>
                     <div class ="col-md-6">
                        <div class="form-group">
                             <?= $form->field($model, 'last_name')->textInput() ?>
                        </div>
                     </div>
                  </div>
                     <div class="row p-lg-2">
                     <div class="col-md-6">
                        <div class="form-group">
                           <?= $form->field($model, 'last_name')->textInput() ?>
                        </div>
                     </div>
                     <div class ="col-md-6">
                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="First name">
                        </div>
                     </div>
                  </div>
                     <div class="row p-lg-2">
                     <div class="col-md-6">
                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="First name">
                        </div>
                     </div>
                     <div class ="col-md-6">
                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="First name">
                        </div>
                     </div>
                  </div>
                  <div class= "col-md-12 text-center">
                     <a class="btn btn-secondary" href="index.html">Cancel</a>
                     <a class="btn btn-primary" href="index.html">Save</a>
                  </div>
                       <?php ActiveForm::end(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

