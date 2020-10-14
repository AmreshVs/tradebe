<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\CategoryUploadForm;
use backend\models\Category;
use backend\models\SubCategory;
use backend\models\MainCategory;


$form = ActiveForm::begin(['id' => 'category-form', 'action' => Yii::$app->request->url]);
?>


<script src="/backend/web/js/common/imgToUrl.js"></script>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
        
          <h3 class="mt-2 mb-3"><?= $model->getIsNewRecord() ? 'Create Main Category' : 'Update Main Category' ?></h3>

            <div class="form-group">
            <label>Image</label>

            <?php if(!$model->getIsNewRecord()){ ?>
            <img src="<?= $model->category_image_path ?>" alt="..." width="500" height="200" class="img-thumbnai" />
            <?php } else{ ?>
              <img src="" id="selected-img" class="img-fluid mb-2 rounded d-none" alt="thumbnail" />
            <?php } ?>
            <div class="form-control p-1">
              <?= $form->field($modelFrom, 'file')->fileInput()->label(false); ?>
            </div>
          </div>
          <div class="form-group">
            <?= $form->field($model, 'category_name')->textInput() ?>
          </div>
          <div class="form-group">
            <?= $form->field($model, 'parent_category')->dropDownList((new Category())->getShopCategoryData(), ['prompt' => 'Please select a Category', 'class' => 'select2 form-control']); ?>
          </div>
          <div class="form-group">
            <label class="w-100">Status</label>
            <label class="switch">
             
                <input type="checkbox" id="banner-category_status" name="Banner[category_status]" onclick="if($(this).prop('checked') == true) { $(this).val(1) } else {$(this).val(0) }"value="<?= $model->category_status == null ? 0 : $model->category_status ?>">
              <span class="slider round"></span>
            </label>
          </div>

            <div class="modal-footer">
            <a href="<?=Url::to(['/sub-category']) ?>">
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