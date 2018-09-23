<form id="file-form" action="handler.php" method="POST" method="post" enctype="multipart/form-data">
  <input type="file" id="file-select" name="photos" multiple/>
  <button type="submit" id="upload-button">Upload</button>
</form>
<script>
 /*
 var form = document.getElementById('file-form');
 var fileSelect = document.getElementById('file-select');
 var uploadButton = document.getElementById('upload-button');

 form.onsubmit = function(event) {
   event.preventDefault();
   uploadButton.innerHTML = 'Uploading...';
   var files = fileSelect.files;
   var formData = new FormData();

   for (var i = 0; i < files.length; i++) {
     var file = files[i];
     
     // Check the file type.
     if (!file.type.match('image.*')) {
       continue;
     }

     // Add the file to the request.
     formData.append('photos[]', file, file.name);
   }
   
   var xhr = new XMLHttpRequest();
   xhr.open('POST', 'handler.php', true);
   xhr.onload = function () {
     if (xhr.status === 200) {
       // File(s) uploaded.
       uploadButton.innerHTML = 'Upload';
     } else {
       alert('An error occurred!');
     }
   };
   xhr.send(formData);
 }
 */
</script>
