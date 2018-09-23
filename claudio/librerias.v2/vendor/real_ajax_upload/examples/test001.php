<!DOCTYPE html>
<html lang="en">
  <head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/ajaxupload-min.js"></script>
  </head>
  <body>
    <link rel="stylesheet" type="text/css" href="css/classicTheme/style.css" />
    <div id="uploader_div"></div>
    <script type="text/javascript">
     $('#uploader_div').ajaxupload({
       url:'upload.php',
       remotePath:'test/',
       maxFileSize:'10G'
     });
    </script>
  </body>
</html>	
