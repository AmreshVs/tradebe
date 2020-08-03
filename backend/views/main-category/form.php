<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\CategoryUploadForm;
use backend\models\MainCategory;

$model = new MainCategory;
$modelForm = new CategoryUploadForm;
$form = ActiveForm::begin(['id' => 'category-form', 'action' => Yii::$app->request->url]);
?>

<div class="form-group">
  <label>Image</label>

  <?php if(!$model->getIsNewRecord()){ ?>
  <img src="<?= $model->main_category_image_path ?>" alt="..." width="500" height="200" class="img-thumbnai" />
  <?php } else{ ?>
    <img src="" id="selected-img" class="img-fluid mb-2 rounded d-none" alt="thumbnail" />
  <?php } ?>
  <div class="form-control p-1">
    <?= $form->field($modelForm, 'file')->fileInput()->label(false); ?>
  </div>
</div>

<div class="form-group">
  <?= $form->field($model, 'main_category_name')->textInput() ?>
</div>

<div class="form-group">
  <label class="w-100">Status</label>
  <label class="switch">
    <input type="checkbox" id="maincategory-main_category_status" name="MainCategory[main_category_status]" value="1">
    <span class="slider round"></span>
  </label>
</div>

<?php ActiveForm::end(); ?>

<script src="/backend/web/js/common/imgToUrl.js"></script>