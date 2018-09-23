<?php 
include ("../../../librerias.v2/html/tabla.php");
include("../../../librerias.v2/mysql/dbconnector.php");
include '../../../librerias.v2/utilidades.php';
include("../models/search.php");
if( isset($_POST) ) { 
  $_POST['fech_ini'] = $_POST['fech_ini'] . '-01-01';
  $_POST['fech_end'] = $_POST['fech_end'] . '-12-31';
  /* print('<pre>'); */
  /* print_r($_POST); */
  /* print('</pre>'); */

  $categorias = explode("|!|", $_POST['tipo']);
  echo '<table><tr>';
  echo '<td><div class="switch"><input id="checkboxSwitch" estado="t" type="checkbox"><label for="checkboxSwitch"></label></div></td>';
  echo '<td><div id="mensaje-checkboxSwitch">Tasación</div></td>';
  echo '</tr></table>';
  $nodo=0;
  // t
  print '<ul class="breadcrumbs menu-grilla" id="menu-t">';
  foreach($categorias as $cat) {
    imprimir_menu($cat,++$nodo);
  }
  print '</ul>';
  // em
  print '<ul class="breadcrumbs menu-grilla" id="menu-em" style="display:none">';
  foreach($categorias as $cat) {
    imprimir_menu($cat,++$nodo);
  }
  print '</ul>';
  $nodo=0;
  $first=true;
  /************ t ************/
  $js1='';
  $js2='';

  foreach($categorias as $cat) {
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
    $data = get_search_grids_t($input);  
    /*print('<pre>a');
    print_r($data);
    print('</pre>');*/
    ++$nodo;
    imprimir_html_t($cat,$data,$nodo,$first);
    $js1.=imprimir_js1($cat,$data,$nodo,$first);
    $js2.=imprimir_js2($cat,$data,$nodo,$first);

    if( isset($data) ){
	$first=false;
    }
  }
  //echo '<script>'.$js1.$js2.'</script>';

  /************ em ************/
//  $js1='';
//  $js2='';

  foreach($categorias as $cat) {
    $input= array(
      'tipo'=>$cat
      , 'departamento'=>$_POST['departamento']
      , 'provincia'=>$_POST['provincia']
      , 'distrito'=>$_POST['distrito']
      , 'fech_ini'=>$_POST['fech_ini']
      , 'fech_end'=>$_POST['fech_end']
      , 'direccion'=>$_POST['direccion']
    );
    $data = get_search_grids_em($input);
    ++$nodo;
    imprimir_html_em($cat,$data,$nodo,$first);
    $js1.=imprimir_js1($cat,$data,$nodo,$first);
    $js2.=imprimir_js2($cat,$data,$nodo,$first);
    if ($first==true) {
    $js1.='$( "#checkboxSwitch" ).trigger( "click" );';
    } 
  
    if( isset($data) ){
	$first=false;
    }
  }
echo '<script>'.$js1.$js2.'</script>';

}/* end-if */
?>
<?php
function imprimir_menu($cat,$nodo) {
  $cat_str = get_categoria($cat);
  printf('<li id="menu-grillar-%s"><a href="#" nodo="%s">%s</a></li>',$nodo,$nodo,$cat_str);
}
function imprimir_html_t($cat,$data,$nodo,$first){ 
  $cat_str='';
  $display='display:none;';
  
  if(is_array($data) and $first==true) {
    $display='display:block;';
  }
  $cat_str = get_categoria($cat);

  ?>
<div style='<?php echo $display ?>' class="menu-grilla-item" id="menu-grilla-item-<?php print $nodo ?>">
     <?php if ( is_array($data) ){ ?>
  <table id="table_<?php print $nodo ?>" cellpadding="0" cellspacing="0">
    <caption>Grilla: <?php echo $cat_str ?></caption>
    <tr>
      <?php if($cat=='casa'){ ?>
	<th>Cliente</th>
	<th>Propietario</th>
	<th>Solicitante</th>
	<th>Ubicacion</th>
	<th>Fecha (Tasacion)</th>
	<th>Zonific ación</th>
	<th>Nro Pisos</th>
	<th>Terreno: Area</th>
	<th>Terreno: Valor Unit.</th>
	<th>Edificacion: Area</th>
	<th>Valor Comercial</th>
	<th>Ruta</th>
      <?php }/*end-if*/ ?>
	<?php if($cat=='departamento'){ ?>
	  <th>Cliente</th>
	  <th>Propietario</th>
	  <th>Solicitante</th>
	  <th>Ubicacion</th>
	  <th>Fecha (Tasacion)</th>
	  <th>Zonifica ción</th>
	  <th>Nro Pisos</th>
	  <th>Ubi Pisos</th>
	  <th>Depart amento (Tipo)</th>
	  <th>Terreno: Area</th>
	  <th>Terreno: Valor Unit.</th>
	  <th>Edificacion: Area</th>
	  <th>Valor Comercial</th>
	  <th>Valor Ocupada</th>
	  <th>Estacion amientos</th>
	  <th>Ruta</th>
	<?php }/*end-if*/ ?>
	  <?php if($cat=='local_industrial'){ ?>
	    <th>Cliente</th>
	    <th>Propietario</th>
	    <th>Solicitante</th>

	    <th>Ubicacion</th>
	    <th>Fecha (Tasacion)</th>
	    <th>Zonifica ción</th>

	    <th>Nro Pisos</th>
	    <th>Terreno: Area</th>
	    <th>Terreno: Valor Unit.</th>

	    <th>Edificacion: Area</th>
	    <th>Valor Comercial</th>
	    <th>Areas Comple mentaria</th>

	    <th>Ruta</th>
	  <?php }/*end-if*/ ?>

	    <?php if($cat=='local_comercial'){ ?>
	      <th>Cliente</th>
	      <th>Propietario</th>
	      <th>Solicitante</th>

	      <th>Ubicacion</th>
	      <th>Fecha (Tasacion)</th>
	      <th>Zonifica ción</th>

	      <th>Nro Pisos</th>
	      <th>Vista de local</th>
	      <th>Terreno: Area</th>

	      <th>Terreno: Valor Unit.</th>
	      <th>Edificacion: Area</th>
	      <th>Valor Comercial</th>

	      <th>Valor Ocupa pada</th>
	      <th>Ruta</th>
	    <?php }/*end-if*/ ?>
	      <?php if($cat=='terreno'){ ?>
		<th>Cliente</th>
		<th>Propietario</th>
		<th>Solicitante</th>

		<th>Ubicacion</th>
		<th>Fecha (Tasacion)</th>
		<th>Zonifica ción</th>

		<th>Cultivo tipo</th>
		<th>Terreno: Area</th>
		<th>Terreno: Valor Unit.</th>

		<th>Valor Comercial</th>
		<th>Ruta</th>
	      <?php }/*end-if*/ ?>
    </tr>
    <?php
    if($cat=='casa'){
      foreach($data as $row) {
	echo '<tr>';
	printf("<td>%s</td>",utf8_encode($row['cliente']) );
	printf("<td>%s</td>",utf8_encode($row['propietario']) );
	printf("<td>%s</td>",utf8_encode($row['solicitante']) );

	printf("<td>%s</td>",utf8_encode($row['ubicacion']) );
	printf("<td>%s</td>",$row['tasacion_fecha']);
	printf("<td>%s</td>",$row['zonificacion']);

	printf("<td>%s</td>",$row['piso_cantidad']);
	printf("<td>%1.2f</td>",$row['terreno_area']);
	printf("<td>%1.2f</td>",$row['terreno_valorunitario']);

	printf("<td>%1.2f</td>",$row['edificacion_area']);
	printf("<td>%1.2f</td>",$row['valor_comercial']);
	printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</td>",utf8_encode($row['ruta_informe']) );
	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='departamento'){
      foreach($data as $row) {
	echo '<tr>';
	printf("<td>%s</td>",utf8_encode($row['cliente']) );
	printf("<td>%s</td>",utf8_encode($row['propietario']) );
	printf("<td>%s</td>",utf8_encode($row['solicitante']) );

	printf("<td>%s</td>",utf8_encode($row['ubicacion']));
	printf("<td>%s</td>",$row['tasacion_fecha']);
	printf("<td>%s</td>",utf8_encode($row['zonificacion']) );

	printf("<td>%s</td>",$row['piso_cantidad']);
	printf("<td>%s</td>",$row['piso_ubicacion']);
	printf("<td>%s</td>",$row['departamento_tipo']);

	printf("<td>%1.2f</td>",$row['terreno_area']);
	printf("<td>%1.2f</td>",$row['terreno_valorunitario']);
	printf("<td>%1.2f</td>",$row['edificacion_area']);

	printf("<td>%1.2f</td>",$row['valor_comercial']);
	printf("<td>%1.2f</td>",$row['valor_ocupada']);
	printf("<td>%s</td>",$row['estacionamiento_cantidad']);

	printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</td>",utf8_encode($row['ruta_informe']) );

	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='local_comercial'){
      foreach($data as $row) {
	echo '<tr>';
	printf("<td>%s</td>",utf8_encode($row['cliente']) );
	printf("<td>%s</td>",utf8_encode($row['propietario']) );
	printf("<td>%s</td>",utf8_encode($row['solicitante']) );

	printf("<td>%s</td>",utf8_encode($row['ubicacion']));
	printf("<td>%s</td>",$row['tasacion_fecha']);
	printf("<td>%s</td>",utf8_encode($row['zonificacion']) );

	printf("<td>%s</td>",$row['piso_cantidad']);
	printf("<td>%s</td>",$row['vista_local']);
	printf("<td>%1.2f</td>",$row['terreno_area']);

	printf("<td>%1.2f</td>",$row['terreno_valorunitario']);
	printf("<td>%1.2f</td>",$row['edificacion_area']);
	printf("<td>%s</td>",$row['valor_comercial']);

	printf("<td>%s</td>",$row['areas_complementarias']);
	printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</td>",utf8_encode($row['ruta_informe']) );

	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='local_industrial'){
      foreach($data as $row) {
	if ($row['areas_complementarias']=='0'){
	  $row['areas_complementarias']='NO';
	}
	echo '<tr>';
	printf("<td>%s</td>",utf8_encode($row['cliente']) );
	printf("<td>%s</td>",utf8_encode($row['propietario']) );
	printf("<td>%s</td>",utf8_encode($row['solicitante']) );

	printf("<td>%s</td>",utf8_encode($row['ubicacion']));
	printf("<td>%s</td>",$row['tasacion_fecha']);
	printf("<td>%s</td>",utf8_encode($row['zonificacion']) );

	printf("<td>%s</td>",$row['piso_cantidad']);
	printf("<td>%1.2f</td>",$row['terreno_area']);
	printf("<td>%1.2f</td>",$row['terreno_valorunitario']);

	printf("<td>%1.2f</td>",$row['edificacion_area']);
	printf("<td>%s</td>",$row['valor_comercial']);
	printf("<td>%s</td>",$row['areas_complementarias']);

	printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</td>",utf8_encode($row['ruta_informe']) );

	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='terreno'){
      foreach($data as $row) {
	echo '<tr>';
	printf("<td>%s</td>",utf8_encode($row['cliente']) );
	printf("<td>%s</td>",utf8_encode($row['propietario']) );
	printf("<td>%s</td>",utf8_encode($row['solicitante']) );

	printf("<td>%s</td>",utf8_encode($row['ubicacion']));
	printf("<td>%s</td>",$row['tasacion_fecha']);
	printf("<td>%s</td>",utf8_encode($row['zonificacion']) );

	printf("<td>%s</td>",$row['cultivo_tipo']);
	printf("<td>%1.2f</td>",$row['terreno_area']);
	printf("<td>%1.2f</td>",$row['terreno_valorunitario']);

	printf("<td>%s</td>",$row['valor_comercial']);
	printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</td>",utf8_encode($row['ruta_informe']) );

	echo '</tr>';
      }
    }/*end-if*/ 
    ?>
  </table>
     <?php 
     }/*is_array*/ 
?>
</div>
  <?php } /*end function*/ ?>

<?php function imprimir_html_em($cat,$data,$nodo,$first){ ?>
  <?php
  $cat_str='';
  $display='display:none;';
  
  if(is_array($data) and $first==true) {
    $display='display:block;';
  }
  $cat_str = get_categoria($cat);

  ?>
<div style='<?php echo $display ?>' class="menu-grilla-item" id="menu-grilla-item-<?php print $nodo ?>">
     <?php if ( is_array($data) ){ ?>
  <table id="table_<?php print $nodo ?>" cellpadding="0" cellspacing="0">
    <caption>Grilla: <?php echo $cat_str ?></caption>
    <tr>
      <?php if($cat=='casa'){ ?>
	<th>Ubicación</th><th>Estudio Fecha</th><th>Area Terreno</th>
	<th>Med</th><th>Valor Unitario Terr.</th><th>Med</th>
	<th>Edificacion</th><th>Med</th><th>Valor Comercial</th>
	<th>Pisos</th> <th>Contacto</th> <th>Teléfono</th>
	<th>Zonificación</th> <th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($cat=='departamento'){ ?>
	<th>Ubicación</th> <th>Estudio Fecha</th> <th>Area Terreno</th>
	<th>Med</th> <th>Valor Unitar Terr.</th> <th>Med</th>
	<th>Estacion amiento</th> <th>Tipo</th> <th>Areas Complementarias </th>
	<th>Pisos</th> <th>Pisos Ubi.</th> <th>Edificacion</th>
        <th>Med</th> <th>Valor Comercial</th>  <th>Contacto</th> 
        <th>Teléfono</th> <th>Zonificación</th> <th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($cat=='local_industrial'){ ?>
	<th>Ubicación</th> <th>Estudio Fecha</th> <th>Area Terreno</th>
	<th>Med</th> <th>Valor Unitar Terr.</th> <th>Med</th>
	<th>Area Edificacion </th> <th>Med</th> <th>Valor Comercial</th> 
        <th>Pisos</th> <th>Contacto</th> <th>Teléfono</th>
        <th>Zonificación</th> <th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($cat=='local_comercial'){ ?>
	<th>Ubicación</th> <th>Estudio Fecha</th> <th>Area Terreno</th>
	<th>Med</th> <th>Valor Unitar Terr.</th> <th>Med</th>
	<th>Pisos</th> <th>Vista Local</th> <th>Area Edificacion </th>
        <th>Med</th> <th>Valor Comercial</th>  <th>Contacto</th> 
        <th>Teléfono</th> <th>Zonificación</th> <th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($cat=='terreno'){ ?>
	<th>Ubicación</th> <th>Estudio Fecha</th> <th>Area Terreno</th>
	<th>Med</th> <th>Valor Unitar Terr.</th> <th>Med</th>
        <th>Valor Comercial</th>  <th>Contacto</th> <th>Teléfono</th> 
	<th>Zonificación</th> <th>Ruta</th>
      <?php }/*end-if*/ ?>
    </tr>
    <?php
    if($cat=='casa'){
      foreach($data as $row) {
	echo '<tr>';
	printf('<td>%s</td>', utf8_encode($row['ubicacion']) );
	printf('<td>%s</td>', $row['estudio_fecha'] );
	printf('<td>%1.2f</td>', $row['terreno_area'] );

	printf('<td>%s</td>', utf8_encode($row['terreno_area_uni']) );
	printf('<td>%1.2f</td>', $row['terreno_valorunitario'] );
	printf('<td>%s</td>', utf8_encode($row['terreno_valorunitario_uni']) );

	printf('<td>%1.2f</td>', $row['edificacion_area'] );
	printf('<td>%s</td>', utf8_encode($row['edificacion_area_uni']) );
	printf('<td>%1.2f</td>', $row['valor_comercial'] );

	printf('<td>%s</td>', $row['piso_cantidad'] );
	printf('<td>%s</td>', utf8_encode($row['contacto']) );
	printf('<td>%s</td>', utf8_encode($row['telefono']) );

	printf('<td>%s</td>', utf8_encode($row['zonificacion']) );
	printf('<td><a href="#" class="button ruta" ruta="%s">Ruta</a></td>', utf8_encode($row['ruta_informe']) );
	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='departamento'){
      foreach($data as $row) {
	echo '<tr>';

	printf('<td>%s</td>', utf8_encode($row['ubicacion']) );
	printf('<td>%s</td>', $row['estudio_fecha'] );
	printf('<td>%1.2f</td>', $row['terreno_area'] );

	printf('<td>%s</td>', utf8_encode($row['terreno_area_uni']) );
	printf('<td>%1.2f</td>', $row['terreno_valorunitario'] );
	printf('<td>%s</td>', utf8_encode($row['terreno_valorunitario_uni']) );

	printf('<td>%s</td>', utf8_encode($row['estacionamiento_cantidad']) );
	printf('<td>%s</td>', utf8_encode($row['departamento_tipo']) );
	printf('<td>%1.2f</td>', $row['areas_complementarias'] );

	printf('<td>%s</td>', $row['piso_cantidad'] );
	printf('<td>%s</td>', $row['piso_ubicacion'] );
	printf('<td>%1.2f</td>', $row['edificacion_area'] );

	printf('<td>%s</td>', utf8_encode($row['edificacion_area_uni']) );
	printf('<td>%1.2f</td>', $row['valor_comercial'] );
	printf('<td>%s</td>', utf8_encode($row['contacto']) );

	printf('<td>%s</td>', utf8_encode($row['telefono']) );
	printf('<td>%s</td>', utf8_encode($row['zonificacion']) );
	printf('<td><a href="#" class="button ruta" ruta="%s">Ruta</a></td>', utf8_encode($row['ruta_informe']) );
	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='local_comercial'){

      foreach($data as $row) {
	echo '<tr>';
	printf('<td>%s</td>', utf8_encode($row['ubicacion']) );
	printf('<td>%s</td>', $row['estudio_fecha'] );
	printf('<td>%1.2f</td>', $row['terreno_area'] );

	printf('<td>%s</td>', utf8_encode($row['terreno_area_uni']) );
	printf('<td>%1.2f</td>', $row['terreno_valorunitario'] );
	printf('<td>%s</td>', utf8_encode($row['terreno_valorunitario_uni']) );

	printf('<td>%s</td>', $row['piso_cantidad'] );
	printf('<td>%s</td>', $row['vista_local'] );
	printf('<td>%1.2f</td>', $row['edificacion_area'] );

	printf('<td>%s</td>', utf8_encode($row['edificacion_area_uni']) );
	printf('<td>%1.2f</td>', $row['valor_comercial'] );
	printf('<td>%s</td>', utf8_encode($row['contacto']) );

	printf('<td>%s</td>', utf8_encode($row['telefono']) );
	printf('<td>%s</td>', utf8_encode($row['zonificacion']) );
	printf('<td><a href="#" class="button ruta" ruta="%s">Ruta</a></td>', utf8_encode($row['ruta_informe']) );
	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='local_industrial'){
      foreach($data as $row) {
	if ($row['areas_complementarias']=='0'){
	  $row['areas_complementarias']='NO';
	}
	echo '<tr>';
	printf('<td>%s</td>', utf8_encode($row['ubicacion']) );
	printf('<td>%s</td>', $row['estudio_fecha'] );
	printf('<td>%1.2f</td>', $row['terreno_area'] );

	printf('<td>%s</td>', utf8_encode($row['terreno_area_uni']) );
	printf('<td>%1.2f</td>', $row['terreno_valorunitario'] );
	printf('<td>%s</td>', utf8_encode($row['terreno_valorunitario_uni']) );

	printf('<td>%1.2f</td>', $row['edificacion_area'] );
	printf('<td>%s</td>', utf8_encode($row['edificacion_area_uni']) );
	printf('<td>%1.2f</td>', $row['valor_comercial'] );

	printf('<td>%s</td>', $row['piso_cantidad'] );
	printf('<td>%s</td>', utf8_encode($row['contacto']) );
	printf('<td>%s</td>', utf8_encode($row['telefono']) );

	printf('<td>%s</td>', utf8_encode($row['zonificacion']) );
	printf('<td><a href="#" class="button ruta" ruta="%s">Ruta</a></td>', utf8_encode($row['ruta_informe']) );
	echo '</tr>';
      }
    }/*end-if*/ 

    if($cat=='terreno'){
      /*
      print '<pre>';
      print_r($data);
      print '</pre>';
      */
      foreach($data as $row) {
	echo '<tr>';
	printf('<td>%s</td>', utf8_encode($row['ubicacion']) );
	printf('<td>%s</td>', $row['estudio_fecha'] );
	printf('<td>%1.2f</td>', $row['terreno_area'] );

	printf('<td>%s</td>', utf8_encode($row['terreno_area_uni']) );
	printf('<td>%1.2f</td>', $row['terreno_valorunitario'] );
	printf('<td>%s</td>', utf8_encode($row['terreno_valorunitario_uni']) );

	printf('<td>%1.2f</td>', $row['valor_comercial'] );
	printf('<td>%s</td>', utf8_encode($row['contacto']) );
	printf('<td>%s</td>', utf8_encode($row['telefono']) );

	printf('<td>%s</td>', utf8_encode($row['zonificacion']) );
	printf('<td><a href="#" class="button ruta" ruta="%s">Ruta</a></td>', utf8_encode($row['ruta_informe']) );
	echo '</tr>';
      }
    }/*end-if*/ 
    ?>
  </table>
     <?php 
     }/*is_array*/ 
?>
</div>
  <?php } /*end function*/ ?>

<?php 
function imprimir_js1($cat,$data,$nodo,$first) { 
  $out='';
  if(is_array($data) and $first==true) {
    $out .= '$("#menu-grillar-'.$nodo.'").addClass("current");'."\n";
  }
  if( !is_array($data)  ) {
    $out .= '$("#menu-grillar-'.$nodo.'").addClass("unavailable"); $("#menu-grillar-'.$nodo.' a").attr("nodo","0");'."\n";
  }
  return $out;
}
function imprimir_js2($cat,$data,$nodo,$first) { 
  $out ='';
  if( is_array($data)  ) {
    $out .= '
var table_'.$nodo.'_Props =  {                     
    display_all_text: " [ Mostrar todos ] ",  
    paging: true,
    paging_length: 3,
    };  
   var tf_'.$nodo.' = setFilterGrid( "table_'.$nodo.'" ,table_'.$nodo.'_Props );
            '."\n";
  }
  return $out;
}
function get_categoria($categoria) 
{
  $out='';
  if ($categoria=='casa'){
    $out='Casa';
  }elseif ($categoria=='departamento'){
    $out='Departamento';
  }elseif ($categoria=='local_comercial'){
    $out='Local Comercial';
  }elseif ($categoria=='local_industrial'){
    $out='Local Industrial';
  }elseif ($categoria=='terreno'){
    $out='Terreno';
  }
  else {
    $categoria_str=$categoria;
  }
  return $out;
}/*end function: -- get_categoria -- */
?>
