<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.uploadfile.min.js"></script>
</head>
<body>
Scroll Issue:

<div id="fileuploader">Upload</div>

<script>
$(document).ready(function()
{
     $("#fileuploader").uploadFile({
       url:"upload.php",
       multiple:true,
       fileName:"myfile"
     });
});

</script>
</body>

