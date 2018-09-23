<?php 
include ("../../../librerias.v2/html/tabla.php");
include("../../../librerias.v2/mysql/dbconnector.php");
include("../models/search.php");

if( isset($_POST) ) { 
  // $_POST['tas_ini'] = substr($_POST['tas_ini'], 6, 4).'-'.substr($_POST['tas_ini'], 3, 2).'-'.substr($_POST['tas_ini'], 0, 2);
  // $_POST['tas_end'] = substr($_POST['tas_end'], 6, 4).'-'.substr($_POST['tas_end'], 3, 2).'-'.substr($_POST['tas_end'], 0, 2);
  
  $input = array(
    "cat" => $_POST["cat"]
    , "tipo" => $_POST["tipo"]
    , "marca" => $_POST["marca"]
    , "modelo" => $_POST["modelo"]
    //, "tas_ini" => $_POST["tas_ini"]
    //, "tas_end" => $_POST["tas_end"]
    , "cliente" => $_POST["cliente"]
    , "anio_fabr" => $_POST["anio_fabr"]
  );

  imprimir_menu();
  $nodo = 0;
  $first=true;
  $js='';

  ++$nodo;
  $data = get_search_no_inmubles_t($input,$nodo);
  imprimir_html_t($data,$input['cat'],$nodo,$first);
  $js.=imprimir_js($data,$input['cat'],$nodo,$first);
  if( is_array($data) ) {
    $first=false;
  }

  ++$nodo;
  $data = get_search_no_inmubles_em($input,$nodo);
  imprimir_html_em($data,$input['cat'],$nodo,$first);
  $js.=imprimir_js($data,$input['cat'],$nodo,$first);
  if( is_array($data) ) {
    $first=false;
  }

  echo '<script>'.$js.'</script>';
}

function imprimir_html_t($data, $categoria,$nodo,$first) 
{
  $display='display:none;';
  if ( is_array($data) and $first){
    $display='display:block;';
  }

    if ( is_array($data) ){
    
	?>
<div style="<?php echo $display ?>" id="menu-grilla-item-<?php echo $nodo ?>" class="menu-grilla-item">
<table id="table_<?php echo $nodo ?>" cellpadding="0" cellspacing="0">
      <caption>Grilla: <?php echo get_categoria($categoria) ?></caption>
    <tr>
      <?php if($categoria=='maquinaria'){ ?>
	<th>Cliente</th>
	<th>Propietario</th>
	<th>Solicitante</th>
	<th>Fecha (Tasacion)</th>
	<th>Tipo</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Fabrica ción (Año)</th>
	<th>Valor Similar Nuevo</th>
	<th>Valor Comercial</th>
	<th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($categoria=='vehiculo'){ ?>
	<th>Cliente</th>
	<th>Propietario</th>
	<th>Solicitante</th>
	<th>Fecha (Tasacion)</th>
	<th>Tipo</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Fabrica ción (Año)</th>
	<th>Tracción</th>
	<th>Valor Similar Nuevo</th>
	<th>Valor Comercial</th>
	<th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($categoria=='maquinaria'){ ?>
	<?php
	foreach($data as $row) {
	  echo '<tr>';
	  printf("<td>%s</td>",utf8_encode($row['cliente']) );
	  printf("<td>%s</td>",utf8_encode($row['propietario']) );
	  printf("<td>%s</td>",utf8_encode($row['solicitante']) );
	  
	  printf("<td>%s</td>",$row['tasacion_fecha'] );
	  printf("<td>%s</td>",utf8_encode($row['maquinaria_tipo']) );
	  printf("<td>%s</td>",utf8_encode($row['maquinaria_marca']) );
	  printf("<td>%s</td>",utf8_encode($row['maquinaria_modelo']) );

	  printf("<td>%s</td>",$row['fabricacion_anio']);
	  printf("<td>%1.2f</td>",$row['valor_similar_nuevo']);
	  printf("<td>%1.2f</td>",$row['valor_comercial']);
	  printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</a></td>",utf8_encode($row['ruta_informe']) );
	  echo '</tr>';
	}
	?>
      <?php }/*end-if*/ ?>
      <?php if($categoria=='vehiculo'){ ?>
	<?php
	foreach($data as $row) {
	  echo '<tr>';
	  printf("<td>%s</td>",utf8_encode($row['cliente']) );
	  printf("<td>%s</td>",utf8_encode($row['propietario']) );
	  printf("<td>%s</td>",utf8_encode($row['solicitante']) );
	  
	  printf("<td>%s</td>",$row['tasacion_fecha'] );

	  printf("<td>%s</td>",utf8_encode($row['vehiculo_tipo']) );
	  printf("<td>%s</td>",utf8_encode($row['vehiculo_marca']) );
	  printf("<td>%s</td>",utf8_encode($row['vehiculo_modelo']) );

	  printf("<td>%s</td>",$row['fabricacion_anio']);
	  printf("<td>%s</td>",utf8_encode($row['vehiculo_traccion']) );
	  printf("<td>%1.2f</td>",$row['valor_similar_nuevo']);
	  printf("<td>%1.2f</td>",$row['valor_comercial']);
	  printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</td>",utf8_encode($row['ruta_informe']) );
	  echo '</tr>';	  
	}
	?>
      <?php }/*end-if*/ ?>
</table>
    </div>
<?php } }/*end function: -- imprimir_html_t -- */

function imprimir_html_em($data, $categoria,$nodo,$first) 
{
  $display='display:none;';
  if ( is_array($data) and $first){
    $display='display:block;';
  }
  if ( is_array($data) ){
    
?>
    <div style="<?php echo $display ?>" id="menu-grilla-item-<?php echo $nodo ?>" class="menu-grilla-item">
      <table id="table_<?php echo $nodo ?>" cellpadding="0" cellspacing="0">
      <caption>Grilla: <?php echo get_categoria($categoria) ?></caption>
    <tr>
      <?php if($categoria=='maquinaria'){ ?>
	<th>Fecha</th> <th>Tipo</th> <th>Marca</th>
	<th>Modelo</th> <th>Año</th> <th>Valor Nuevo</th>
	<th>Contacto</th> <th>Teléfono</th> <th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($categoria=='vehiculo'){ ?>
	<th>Fecha</th> <th>Tipo</th> <th>Marca</th>
	<th>Modelo</th> <th>Año</th> <th>Tracción</th> 
        <th>Valor Nuevo</th> <th>Contacto</th> <th>Teléfono</th>
        <th>Ruta</th>
      <?php }/*end-if*/ ?>
      <?php if($categoria=='maquinaria'){ ?>
	<?php
	foreach($data as $row) {
	  echo '<tr>';
	  printf("<td>%s</td>",utf8_encode($row['estudio_fecha']) );
	  printf("<td>%s</td>",utf8_encode($row['tipo']) );
	  printf("<td>%s</td>",utf8_encode($row['marca']) );

	  printf("<td>%s</td>",utf8_encode($row['modelo']) );
	  printf("<td>%s</td>",utf8_encode($row['fabricacion_anio']) );
	  printf("<td>%1.2f</td>",$row['valor_similar_nuevo'] );

	  printf("<td>%s</td>",utf8_encode($row['contacto']) );
	  printf("<td>%s</td>",utf8_encode($row['telefono']) );
	  printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</a></td>",utf8_encode($row['ruta_informe']) );

	  echo '</tr>';
	}
	?>
      <?php }/*end-if*/ ?>
      <?php if($categoria=='vehiculo'){ ?>
	<?php
	foreach($data as $row) {
	  echo '<tr>';
	  printf("<td>%s</td>",utf8_encode($row['estudio_fecha']) );
	  printf("<td>%s</td>",utf8_encode($row['tipo']) );
	  printf("<td>%s</td>",utf8_encode($row['marca']) );

	  printf("<td>%s</td>",utf8_encode($row['modelo']) );
	  printf("<td>%s</td>",utf8_encode($row['fabricacion_anio']) );
	  printf("<td>%s</td>",utf8_encode($row['vehiculo_traccion']) );

	  printf("<td>%1.2f</td>",$row['valor_similar_nuevo'] );
	  printf("<td>%s</td>",utf8_encode($row['contacto']) );
	  printf("<td>%s</td>",utf8_encode($row['telefono']) );

	  printf("<td><a href='#' class='button ruta' ruta='%s'>Ruta</a></td>",utf8_encode($row['ruta_informe']) );
	  echo '</tr>';	  
	}
	?>
      <?php }/*end-if*/ ?>
      </table>
    </div>
	<?php
    }
}/*end function: -- imprimir_html_em -- */

function imprimir_js($data,$categoria,$nodo,$first) 
{
    $out='';
    if (is_array($data) ) {
	$out='
          var table_Props_'.$nodo.'={                     
          display_all_text: " [ Mostrar todos ] ",  
          paging: true,
          paging_length: 5,
          };  
          var tf_'.$nodo.' = setFilterGrid( "table_'.$nodo.'",table_Props_'.$nodo.');
          ';  
	
    }
    if(is_array($data) and $first==true) {
	$out .= '$("#menu-grillar-'.$nodo.'").addClass("current");'."\n";
    }
    if( !is_array($data)  ) {
	$out .= '$("#menu-grillar-'.$nodo.'").addClass("unavailable");'."\n";
	$out .= '$("#menu-grillar-'.$nodo.' a").attr("nodo","0");'."\n";
    }
    return $out;
}/*end function: -- imprimir_js -- */
function get_categoria($categoria) 
{
    $out='';
    if ($categoria=='maquinaria') {
	$out='Maquinaria';
    }elseif ($categoria=='vehiculo') {
	$out='Vehiculo';
    }
    return $out;
}/*end function: -- get_categoria -- */

function imprimir_menu() {
  echo '<ul class="breadcrumbs menu-grilla">';
  printf('<li id="menu-grillar-%s"><a href="#" nodo="%s">%s</a></li>',1,1,'Tasación');
  printf('<li id="menu-grillar-%s"><a href="#" nodo="%s">%s</a></li>',2,2,'Estudio Mercado');
  echo '</ul>';	  
}
?>
