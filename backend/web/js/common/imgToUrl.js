$('#categoryuploadform-file').on('change', async function (e) {
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
