<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';

?>
<div id="layoutAuthentication" class="login" style="background: url('https://images.unsplash.com/photo-1588420343618-6141b3784bce?ixlib=rb-1.2.1&w=1000&q=80')">
  <div id="layoutAuthentication_content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header">
              <h3 class="text-center my-4">Login</h3>
            </div>
            <div class="card-body">
              <?php $form = ActiveForm::begin(['id' => 'login-form']);?>
              <div class="form-group">
                <?=$form->field($model, 'username')->textInput(['autofocus' => true])?>
              </div>
              <div class="form-group">
                <?=$form->field($model, 'password')->passwordInput()?>
              </div>

              <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                <a href="password.html">Forgot Password?</a>
                <?=Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button'])?>
              </div>
              <?php ActiveForm::end();?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>