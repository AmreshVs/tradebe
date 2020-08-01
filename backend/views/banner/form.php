<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\models\Banner;
use backend\models\CategoryUploadForm;

$model = new Banner;
$modelForm = new CategoryUploadForm;

?>

<?php 
  $form = ActiveForm::begin(['id' => 'category-form', 'action' => Url::to(['/banner/create'])]);
?>

<div class="form-group">
  <label>Image</label>

  <?php if(!$model->getIsNewRecord()){ ?>
  <img src="<?= $model->banner_image_path ?>" alt="..." width="500" height="200" class="img-thumbnai" />
  <?php } else{ ?>
    <img src="" id="selected-img" class="img-fluid mb-2 rounded d-none" alt="thumbnail" />
  <?php } ?>
  <div class="form-control p-1">
    <?= $form->field($modelForm, 'file')->fileInput()->label(false); ?>
  </div>
</div>

<div class="form-group">
  <?= $form->field($model, 'banner_name')->textInput() ?>
</div>

<div class="form-group">
  <label class="w-100">Status</label>
  <label class="switch">
    <input type="checkbox" id="banner-banner_status" name="Banner[banner_status]" value="1">
    <span class="slider round"></span>
  </label>
</div>

<?= Html::a('Cancel', Url::to(['/banner']), ['class' => 'btn btn-secondary']); ?>
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>

<script>
  $('#categoryuploadform-file').on('change', async function(e){
    $('#selected-img').attr('src', await getBase64(e.target.files[0]));
    $('#selected-img').toggleClass('d-none');
  });

  function getBase64(file) {
    return new Promise(resolve => {
      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function () {
        resolve(reader.result);
      };
      reader.onerror = function (error) {
        console.log('Error: ', error);
      };
    })
  }
</script>