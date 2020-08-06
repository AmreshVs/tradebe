<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\Category;
use backend\models\Vendor;
use backend\models\MainCategory;

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <?php $form = ActiveForm::begin(['id' => 'vendor-form']); ?>
      <div class="form-group">
        <?= $form->field($model, 'item_name')->textInput() ?>
      </div>
      <div class="form-group">
        <?= $form->field($model, 'item_desc')->textArea() ?>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'vendor_id')->dropDownList(Vendor::get(), ['prompt' => 'Please select a Category', 'class' => 'select2 form-control']); ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'price')->textInput() ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'video_link')->textInput() ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'main_category_id')->dropDownList(MainCategory::get(), ['prompt' => 'Please select a Category', 'class' => 'select2 form-control']); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'category_id')->dropDownList(Category::getShopCategoryData($model->main_category_id), ['prompt' => 'Please select a Category', 'class' => 'select2 form-control']); ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'sub_category_id')->dropDownList(Category::getSub($model->category_id), ['prompt' => 'Please select a Sub Category', 'class' => 'select2 form-control']); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <?= $form->field($model, 'unit_name')->textInput() ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="w-100">Status</label>
            <label class="switch">
              <input type="checkbox" id="item-item_status" name="Item[item_status]" value="1">
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
      <?php if(!$model->getIsNewRecord()){ ?>
        <?php foreach ($modeSpecArr as $key => $spec) { ?>
          <div class="fvrduplicate1">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label>Specification Name</label>
                  <input type="text" value="<?= $spec['item_specification_name'] ?>" class="form-control" name="Specification[][name]" placeholder="RAM">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Specification Value</label>
                  <input type="text" class="form-control" value="<?= $spec['item_specification_value'] ?>" name="Specification[][value]" placeholder="16gb">
                </div>
              </div>
              <div class="col-md-2 d-flex align-items-center pt-3">
                <?php if(count($modeSpecArr) - 1 != $key){ ?>
                  <button class="btn btn-sm btn-remove btn-danger" type="button">
                    <span class="fa fa-minus"></span> Remove
                  </button>
                <?php } else {?>
                  <button class="btn btn-sm btn-success btn-add" type="button">
                    <span class="fa fa-plus"></span> Add
                  </button>
                <?php } ?>
              </div>
            </div>
          </div>
      <?php
          } 
        }
      ?>
      <div class="fvrduplicate d-none">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Specification Name New</label>
              <input type="text" class="form-control" name="Specification[][name]" placeholder="RAM">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label>Specification Value</label>
              <input type="text" class="form-control" name="Specification[][value]" placeholder="16gb">
            </div>
          </div>
          <div class="col-md-2 d-flex align-items-center pt-3">
            <button class="btn btn-sm btn-success btn-add" type="button">
              <span class="fa fa-plus"></span> Add
            </button>
          </div>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  var fvrhtmlclone = '';
  <?php if($model->getIsNewRecord()){ ?>
    $(".fvrduplicate").after('<div class="fvrclone">'+ $('.fvrduplicate').html() +'</div>');
  <?php } else { ?>
    $(".fvrduplicate").after('<div class="fvrclone"></div>');
  <?php } ?>
</script>