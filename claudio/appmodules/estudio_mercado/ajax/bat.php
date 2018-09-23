<?php 
header("Content-type: application/bat");
header("Content-Disposition: attachment; filename=abrir.bat");
if ( isset($_GET['ruta']) ){
    $_GET['ruta'] =  str_replace("\\\\", "\\", $_GET['ruta']);
    ?>
@echo off 
<?php echo "\nexplorer.exe ". $_GET['ruta'] ?>	
    <?php }

?>