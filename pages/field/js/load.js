$(document).ready(function () {
    var textFile = '<input class="btn xs btn-dark" id="btn_add_file" type="file" name="filename">';
    var addFile = document.querySelector('#btn_add_file');
    //var loadFile = document.querySelector('#btn_load_file');
    $('body').on('change', addFile , function (e) {
        //e.stopPropagation();
       //console.log(e);
      var target = e.target.outerHTML;
      var loadFile = document.querySelector('#btn_load_file');
      if(target == textFile) {
          console.log(4);
          // console.log(target);
          var files = e.target.files;
          console.log(files);

        var file = files[0];

        var formData = new FormData();

        formData.append('filename', file);

        const request = new XMLHttpRequest();

        request.addEventListener('load', function () {
            console.log(request.responseText);

        });

        request.open('POST', '../field/php/upload.php');

        request.send(formData);






      }
    });
});