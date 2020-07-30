<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\Category;
use backend\models\Vendor;
use backend\models\MainCategory;



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
                  <h4 class="card-title"><?= $model->getIsNewRecord() ? 'Create Item' : 'Update Item' ?></h4>
                  <hr>
               <?php $form = ActiveForm::begin(['id' => 'vendor-form']); ?>
                  <div class="row p-lg-2">
                     <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'item_name')->textInput() ?>
                        </div>
                     </div>
                  </div>
                  <div class="row p-lg-2">
                     <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($model, 'item_desc')->textArea() ?>
                        </div>
                     </div>
                  </div>
                  <div class="row p-lg-2">
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
                    <div class="row p-lg-2">
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
                   <div class="row p-lg-2">
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
                  <div class="row p-lg-2">
                     <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'unit_name')->textInput() ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                          <label>Status</label>
                            <?=$form->field($model, 'item_status')->checkbox([
                              'data-toggle' => 'toggle',
                              'data-on' => "Ready", 
                              'data-off' => "Not Ready",
                              'data-onstyle' => "primary",
                              'data-offstyle' => "danger"
                            ])->label(false) ?>
                        </div>
                     </div>
                  </div>
<!-- Material checked -->

              <?php if(!$model->getIsNewRecord()){ ?>
                  <?php foreach ($modeSpecArr as $key => $spec) { ?>
                    <?php if(count($modeSpecArr) - 1 != $key){ ?>
                    <div class="fvrclonned">
                    <?php } ?>
                         <div class="fvrduplicate1">
                           <div class="row p-lg-2">
                            <div class="col-md-5">
                              <div class="form-group">
                                <label for="exampleInputName2">Specification Name</label>
                                <input type="text" value="<?= $spec['item_specification_name'] ?>" class="form-control" id="exampleInputName2" name="Specification[][name]" placeholder="RAM" required>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="form-group">
                                <label for="exampleInputEmail2">Specification Value</label>
                                <input type="text" class="form-control" value="<?= $spec['item_specification_value'] ?>" id="exampleInputEmail2" name="Specification[][value]" placeholder="16gb" required>
                              </div>
                          </div>
                      </div>
                    </div>
                  <?php if(count($modeSpecArr) - 1 != $key){ ?>
                    <span><button class="btn btn-remove btn-danger" type="button"><span class="glyphicon glyphicon-minus"></span></button></span>
                    </div>
                  <?php } else {?>
                     <span><button class="btn btn-success btn-add" type="button"><span class="glyphicon glyphicon-minus"></span></button></span>
                  <?php } ?>
                

              <?php } ?>

              <?php } ?>

                  <div class="fvrduplicate hide">
                     <div class="row p-lg-2">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputName2">Specification Name</label>
                          <input type="text" class="form-control" id="exampleInputName2" name="Specification[][name]" placeholder="RAM" required>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputEmail2">Specification Value</label>
                          <input type="text" class="form-control" id="exampleInputEmail2" name="Specification[][value]" placeholder="16gb" required>
                        </div>
                    </div>
                </div>
              </div>

                  <div class= "col-md-12 text-center">
                     <?= Html::a('Cancel', Url::to(['/item']), ['class' => 'btn btn-secondary']); ?>
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

    $(document).ready(function(){
         <?php if(!$model->getIsNewRecord()){ ?>
          $('.hide').hide();
        <?php } else { ?>
          $('.hide').show(); 
        <?php } ?>
        var buttonadd = '<span><button class="btn btn-success btn-add" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>';
        var fvrhtmlclone = '<div class="fvrclonned">'+$(".fvrduplicate").html()+buttonadd+'</div>';
        $( ".fvrduplicate" ).html(fvrhtmlclone);
        $( ".fvrduplicate" ).after('<div class="fvrclone"></div>');

        $(document).on('click', '.btn-add', function(e)
        {
            e.preventDefault();
    
            $( ".fvrclone" ).append(fvrhtmlclone);
                  $(this).removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');
            
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('[class^=fvrclonned]').remove();
            $(this).parents('[class^=fvrclonned1]').remove();
    
        e.preventDefault();
        return false;
      });





    });
    
     $('#item-main_category_id').on('change', function(){
     $("#item-category_id").empty();
       $.ajax({
            type: "POST",
            url: '<?= Url::to(['get-main-category']) ?>',
            data: {id : $(this).val() },
            success: function(result) {
                $("#item-category_id").append('<option value="">Please Select Option</option>');
                 $.each(result.data, function (idx, obj) {
                      $("#item-category_id").append('<option value="' + idx + '">' + obj + '</option>');
                  }); 
                 $('#item-category_id').trigger('change');
                 //$("#item-sub_category_id").trigger('liszt:updated');
                
            }
        });
    });

    $('#item-category_id').change(function(){
      $("#item-sub_category_id").empty();
       $.ajax({
            type: "POST",
            url: '<?= Url::to(['get-sub-category']) ?>',
            data: {id : $(this).val() },
            success: function(result) {
                $("#item-sub_category_id").append('<option value="">Please Select Option</option>');
                 $.each(result.data, function (idx, obj) {
                      $("#item-sub_category_id").append('<option value="' + idx + '">' + obj + '</option>');
                  }); 
                 $('#item-sub_category_id').trigger('change');
                 //$("#item-sub_category_id").trigger('liszt:updated');
                
            }
        });
    });

  $('.select2').select2();


    </script>