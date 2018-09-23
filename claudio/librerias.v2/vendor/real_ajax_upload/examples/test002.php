<!DOCTYPE html>
<html lang="en">
  <head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/ajaxupload-min.js"></script>

  </head>
  <body>
    <link rel="stylesheet" type="text/css" href="css/baseTheme/style.css" />
    <div id="uploader_div" class="ax-uploader"></div>
    <script type="text/javascript">
     $('#uploader_div').ajaxupload({
       url:'upload.php',
       remotePath:'test/',
       data:'asd=asd&qwe=123',
       thumbHeight:200,
       autoStart:true, 
       finish:function(files, filesObj){         
         console.log( 'All files has been uploaded:' + filesObj );
       },
       success:function(file){
         console.log( 'File ' + file + ' uploaded correctly' );
       },
       beforeUpload: function(filename, fileobj){
         if(filename.length>20) {
           return false; //file will not be uploaded
         }
         else {
           return true; //file will be uploaded
         }
       },
       error:function(txt, obj){
         alert('An error occour '+ txt);
       }
     });
    </script>
  </body>
</html>	
