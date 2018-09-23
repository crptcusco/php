<div id="map" style="width: 100%; height: 600px;"></div>
<?php 
include("../../../librerias.v2/html/tabla.php");
include("../../../librerias.v2/mysql/dbconnector.php");
include '../../../librerias.v2/utilidades.php';
include("../models/search.php");


if( isset($_POST) ) { 
    $_POST['fech_ini'] = $_POST['fech_ini'] . '-01-01';
    $_POST['fech_end'] = $_POST['fech_end'] . '-12-31';
    
    $categorias = explode("|!|", $_POST['tipo']);
    
    printf('<div id="listado-categorias" style="display:none">%s</div>', $_POST['tipo']);
    $data = array();

    foreach ($categorias as $cat) {
        // tasacion ----------------------------------------
        $input= array(
            'tipo'=>$cat
          , 'departamento'=>$_POST['departamento']
          , 'provincia'=>$_POST['provincia']
          , 'distrito'=>$_POST['distrito']
          , 'fech_ini'=>$_POST['fech_ini']
          , 'fech_end'=>$_POST['fech_end']
          , 'cliente'=>$_POST['cliente']
          , 'direccion'=>$_POST['direccion']
        );
        $tmp = get_search_map_t($input);
        if ( is_array($tmp) ) {
            $data = array_merge($data, $tmp);
        }
        
        // estudio de mercado -------------------------------
        if ( '' == trim($_POST['cliente'])) {
            $input= array (
                'tipo'=>$cat
                , 'departamento'=>$_POST['departamento']
                , 'provincia'=>$_POST['provincia']
                , 'distrito'=>$_POST['distrito']
                , 'fech_ini'=>$_POST['fech_ini']
                , 'fech_end'=>$_POST['fech_end']
                , 'direccion'=>$_POST['direccion']
            );
            $tmp = get_search_map_em($input);
            if ( is_array($tmp) ){
                $data = array_merge($data, $tmp);
            }	
        }

    }
    // Utilidades::print_r('$_POST', $_POST);
    // Utilidades::print_r('$data', $data);
  ?>
<script>
   
   // Define your locations: HTML content for the info window, latitude, longitude
   var locations = [
   <?php
   $distinct[0] = array();
   $t=0;
   foreach($data as $row) {
       $t++;
       
       if (strlen($row['latitud'])>=7 && strlen($row['longitud'])>=7 ) {
           $row['distinct']=(string)$row['distinct'];
           $index = array_search($row['distinct'], $distinct);
           if ($index==false) {
               $distinct[] = $row['distinct'];
               printf(
                   '[%s,%s,"%s"]'.",\n"
                 , $row['latitud']      
                 , $row['longitud']
                 , $row['tipo']
               );       
           }
       }
   }
   ?>
 ];
</script>
<script src="../../static/js/estudio_de_mercado_map.js" async="async"></script>

<?php } ?>
