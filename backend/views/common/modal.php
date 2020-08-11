<?php
use yii\bootstrap\ActiveForm;

  if(isset($name)){
    $modalName = str_replace(' ', '', $name).'Modal';
    $modalHeading = $model->getIsNewRecord() ? 'Create ' . $name : 'Update '. $name;
    $modalSize = isset($modalSize) ? $modalSize : '';
?>

    <!-- Modal -->
    <div class="modal fade" id="<?=$modalName?>" tabindex="-1" role="dialog" aria-labelledby="<?=$modalName?>Label"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered <?=$modalSize?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="<?=$modalName?>Label">
              
            </h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <em class="fa fa-times-circle"></em>
              Close
            </button>
            <button type="submit" class="btn btn-primary" id="save">
              <em class="fa fa-save"></em>
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>

<?php
  }
?>

<script>
  <?php
    if(isset($name)){
  ?>
      function renderModal(url, type = 'create') {
        if(type === 'create'){
          $('.modal-title').html('Create <?=$name?>');
        }

        let modalBody = $('#<?=$modalName?> .modal-body');
        let loader = `<?php include(Yii::$app->basePath . '/views/common/loader.php'); ?>`;
        modalBody.html(loader);

        $.ajax({
          url: type === 'create' ? '<?=$baseUrl . '/create'?>' : url,
          method: 'GET',
          success: function(data) {
            modalBody.html(data);
          }
        });
      }

      $('#create').on('click', function(){
        renderModal();
      });

      $('.edit-btn').on('click', function(e){
        $('.modal-title').html('Update <?=$name?>');
        e.preventDefault();
        renderModal(e.currentTarget.href, 'update');
      });

      $('#save').on('click', function() {
        let form = $('.modal-body form');
       
        let url = form.attr('action');
        let modalBody = $('#<?=$modalName?> .modal-body');

        $.ajax({
          url: url,
          method: 'POST',
          data: form.serialize(),
          success: function(data) {
            if (data.status === 200) {
              location.reload();
            }
            else{
              modalBody.html(data);
            }
          }
        })
      });

      function deleteRow($url) {
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to revert!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("<?=$name?> has been deleted!", {
              icon: "success",
            });
            location.href = '<?=$baseUrl . '/delete'?>/' + $url;
          }
        });
        return false;
      }

      $('.table .status').on('change', function() {
        $this = $(this);
        let value = 0;
        if ($(this).prop("checked") == true) {
          value = 1;
        }
        $.ajax({
          url: '<?=$baseUrl . '/status'?>',
          data: {
            id: $this.closest('tr').attr('data-key'),
            status: value
          },
          success: function(json) {
            // toastr.success(json.msg, 'Success', {
            //   timeOut: 3000
            // })
          }
        });
      });
  <?php
    }
  ?>
</script>