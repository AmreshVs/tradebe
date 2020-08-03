<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin(['id' => 'category-form', 'action' => Yii::$app->request->url]); ?>
<div class="form-group">
  <?= $form->field($model, 'city_name')->textInput() ?>
</div>
<div class="form-group">
  <label class="w-100">Status</label>
  <label class="switch">
    <input type="checkbox" id="city-city_status" name="City[city_status]" value="1">
    <span class="slider round"></span>
  </label>
</div>
<?php ActiveForm::end(); ?>