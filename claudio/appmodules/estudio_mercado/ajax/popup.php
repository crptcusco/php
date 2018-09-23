<?php
include("../../../librerias.v2/mysql/dbconnector.php");
include("../models/search.php");
include '../../../librerias.v2/utilidades.php';

if ( isset($_POST['latitud']) && isset($_POST['longitud'])  && 
     isset($_POST['categorias']) ) {

    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $categorias = explode( "|!|", $_POST['categorias'] );
    //printf('<table border="1"><tr><td>%s</td><td>%s</td></tr></table>',$latitud,$longitud);
    echo '
    <table id="mm-popup">
    <tr>
    <td><div class="switch"><input id="checkboxSwitch-popup" estado="t" type="checkbox"><label for="checkboxSwitch-popup"></label></div></td>
    <td><div id="mensaje-checkboxSwitch-popup">Tasación</div></td>
    </tr>
    </table>
    ';

    $nodo=0;
    print '<ul class="breadcrumbs menu-grilla-popup" id="menu-grilla-popup-t">';
    foreach($categorias as $categoria) {
        imprimir_menu($categoria,++$nodo);
    }
    print '</ul>';
    
    print '<ul class="breadcrumbs menu-grilla-popup" id="menu-grilla-popup-em" style="display:none">';
    foreach($categorias as $categoria) {
        imprimir_menu($categoria,++$nodo);
    }
    print '</ul>';
    
    $nodo=0;
    $first=true;
    $js='';
    // t   
    foreach($categorias as $categoria) {
        $input = array(
            'latitud' => $latitud
          , 'longitud' => $longitud
          , 'categoria' => $categoria
        );
        // Utilidades::print_r('$input',$input);
        $data = search_marker_t($input);
        ++$nodo;
        imprimir_html_t($data, $categoria,$nodo,$first);
        $js.=imprimir_js($data, $categoria,$nodo,$first);
        if( isset($data) ) {
            $first=false;
        }
    }
    //em
    foreach($categorias as $categoria) {
        $input = array(
            'latitud' => $latitud
          , 'longitud' => $longitud
          , 'categoria' => $categoria
        );
        // Utilidades::var_dump('',$input);
        $data = search_marker_em($input);
        ++$nodo;
        imprimir_html_em($data, $categoria,$nodo,$first);
        $js.=imprimir_js($data, $categoria,$nodo,$first);
        if ($first==true) {
            $js.='$("#checkboxSwitch-popup").trigger( "click" );'."\n";
            $js.='$("#checkboxSwitch-popup").attr("estado","em");'."\n";
            $js.='$("#menu-grilla-popup-t").hide();'."\n";
            $js.='$("#menu-grilla-popup-em").show();'."\n";
            $js.='$("#mensaje-checkboxSwitch-popup").text("Estudio de Mercado");'."\n";
        }
        if( isset($data) ){
    	    $first=false;
        }
    }
    echo '<script>'.$js.'</script>';
}
function imprimir_menu($categoria,$nodo) {
    printf('<li id="menu-grilla-popup-%s">
              <a href="#" nodo="%s"
                 style="font-size:2em">%s</a></li>'
	 , $nodo
	 , $nodo
	 , get_categoria($categoria)
	 );
}
function get_categoria ($cat) {
  $cat_str='';
  if ($cat=='casa'){
    $cat_str='Casa';
  }elseif ($cat=='departamento'){
    $cat_str='Departamento';
  }elseif ($cat=='local_comercial'){
    $cat_str='Local Comercial';
  }elseif ($cat=='local_industrial'){
    $cat_str='Local Industrial';
  }elseif ($cat=='terreno'){
    $cat_str='Terreno';
  }
  else {
    $cat_str=$cat;
  }
  return $cat_str;
}
function imprimir_js($data, $categoria, $nodo,$first) {
  $out='';
  if(is_array($data) and $first==true) {
    $out.= '$("#menu-grilla-popup-'.$nodo.'").addClass("current");'."\n";
  }
  if(!is_array($data)) {
    $out.='$("#menu-grilla-popup-'.$nodo.'").addClass("unavailable");'."\n";
    $out.='$("#menu-grilla-popup-'.$nodo.' a").attr("nodo","0");'."\n";
  }
  return $out;
}
function imprimir_html_t ($data, $categoria, $nodo,$first) {
    $display='display:none';
    if(is_array($data) and $first==true) {
        $display='display:block;';
    }
    echo '<div style="' . $display . '" class="menu-grilla-popup-item"
               id="menu-grilla-popup-item-' . $nodo . '">';
    
    if ( is_array($data) ) {
        echo '<table id="table1" class="no-margin" 
                     cellpadding="0" cellspacing="0">';
        if($categoria=='casa') {
            $l = array(
                array('label' => 'Ruta', 'type'=>'ruta', 'val'=>'ruta_informe'),
                array('label' => 'Ubicación', 'type'=>'text', 'val'=>'ubicacion'),
                array('label' => 'Fecha (Tasacion)', 'type'=>'text', 'val'=>'tasacion_fecha'),
                array('label' => 'Zonificación', 'type'=>'text', 'val'=>'zonificacion'),
                array('label' => 'Nro Pisos', 'type'=>'text', 'val'=>'piso_cantidad'),
                array('label' => 'Terreno: Area', 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'float', 'val'=>'terreno_valorunitario'),
                array('label' => 'Edificacion', 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial', 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Cliente', 'type'=>'text', 'val'=>'cliente'),
                array('label' => 'Propietario', 'type'=>'text', 'val'=>'propietario'),
                array('label' => 'Solicitante', 'type'=>'text', 'val'=>'solicitante'),
            );            
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='departamento') {
            $l = array(
                array('label' => 'Ruta', 'type'=>'ruta', 'val'=>'ruta_informe'),
                array('label' => 'Ubicación'          , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (Tasacion)'   , 'type'=>'text' , 'val'=>'tasacion_fecha'),
                array('label' => 'Zonificación'       , 'type'=>'text' , 'val'=>'zonificacion'),
                array('label' => 'Nro Pisos'          , 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Ubi Piso'           , 'type'=>'text' , 'val'=>'piso_ubicacion'),
                array('label' => 'Departamento (Tipo)', 'type'=>'text' , 'val'=>'departamento_tipo'),                    
                array('label' => 'Terreno: Area'       , 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'float', 'val'=>'terreno_valorunitario'),
                array('label' => 'Edificacion'         , 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial'     , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Valor Ocupada'       , 'type'=>'float', 'val'=>'valor_ocupada'),
                array('label' => 'Num Estacionamientos', 'type'=>'text' , 'val'=>'estacionamiento_cantidad'),
                array('label' => 'Cliente'            , 'type'=>'text' , 'val'=>'cliente'),
                array('label' => 'Propietario'        , 'type'=>'text' , 'val'=>'propietario'),
                array('label' => 'Solicitante'        , 'type'=>'text' , 'val'=>'solicitante'),
            );            
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);               
                echo '</table></tr>';
            }
        }
        if($categoria=='local_comercial') {
            $l = array(
                array('label' => 'Ruta'                , 'type'=>'ruta' , 'val'=>'ruta_informe'),
                array('label' => 'Ubicación'           , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (Tasacion)'    , 'type'=>'text' , 'val'=>'tasacion_fecha'),
                array('label' => 'Zonificación'        , 'type'=>'text' , 'val'=>'zonificacion'),
                array('label' => 'Nro Pisos'           , 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Vista Local'         , 'type'=>'text' , 'val'=>'vista_local'),
                array('label' => 'Terreno: Area'       , 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'float', 'val'=>'terreno_valorunitario'),
                array('label' => 'Edificacion'         , 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial'     , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Areas Complement'    , 'type'=>'text' , 'val'=>'areas_complementarias'),
                array('label' => 'Cliente'             , 'type'=>'text' , 'val'=>'cliente'),
                array('label' => 'Propietario'         , 'type'=>'text' , 'val'=>'propietario'),
                array('label' => 'Solicitante'         , 'type'=>'text' , 'val'=>'solicitante'),               
            );            
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                if ($row['areas_complementarias']=='0' || $row['areas_complementarias']=='') {
                    $row['areas_complementarias']='NO';
                }
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='local_industrial') {
            $l = array(
                array('label' => 'Ruta'                , 'type'=>'ruta' , 'val'=>'ruta_informe'),                
                array('label' => 'Ubicación'           , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (Tasacion)'    , 'type'=>'text' , 'val'=>'tasacion_fecha'),
                array('label' => 'Zonificación'        , 'type'=>'text' , 'val'=>'zonificacion'),
                array('label' => 'Nro Pisos'           , 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Terreno: Area'       , 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'float', 'val'=>'terreno_valorunitario'),
                array('label' => 'Edificacion'         , 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial'     , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Areas Complement'    , 'type'=>'text' , 'val'=>'areas_complementarias'),
                array('label' => 'Cliente'             , 'type'=>'text' , 'val'=>'cliente'),
                array('label' => 'Propietario'         , 'type'=>'text' , 'val'=>'propietario'),
                array('label' => 'Solicitante'         , 'type'=>'text' , 'val'=>'solicitante'),
            );
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                if ($row['areas_complementarias']=='0' || $row['areas_complementarias']=='') {
                    $row['areas_complementarias']='NO';
                }
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='terreno') {
            $l = array (
                array('label' => 'Ruta'                , 'type'=>'ruta' , 'val'=>'ruta_informe'),
                array('label' => 'Ubicación'           , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (Tasacion)'    , 'type'=>'text' , 'val'=>'tasacion_fecha'),
                array('label' => 'Zonificación'        , 'type'=>'text' , 'val'=>'zonificacion'),
                array('label' => 'Nro Pisos'           , 'type'=>'text' , 'val'=>'cultivo_tipo'),
                array('label' => 'Terreno: Area'       , 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'float', 'val'=>'terreno_valorunitario'),
                array('label' => 'Valor Comercial'     , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Cliente'             , 'type'=>'text' , 'val'=>'cliente'),
                array('label' => 'Propietario'         , 'type'=>'text' , 'val'=>'propietario'),
                array('label' => 'Solicitante'         , 'type'=>'text' , 'val'=>'solicitante'),
            );
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='oficina') {
            $l = array (
                array( 'type' => 'text' ,  'val' => 'cliente', 'label' => 'Cliente'),
                array( 'type' => 'text' ,  'val' => 'propietario', 'label' => 'Propietario'),
                array( 'type' => 'text' ,  'val' => 'solicitante', 'label' => 'Solicitante'),
                array( 'type' => 'text' ,  'val' => 'ubicacion', 'label' => 'Ubicacion'),
                array( 'type' => 'text' ,  'val' => 'tasacion_fecha', 'label' => 'Fecha'),
                array( 'type' => 'text' ,  'val' => 'zonificacion', 'label' => 'Zonificacion'),
                array( 'type' => 'text' ,  'val' => 'piso_cantidad', 'label' => 'Pisos'),
                array( 'type' => 'text' ,  'val' => 'piso_ubicacion', 'label' => 'Ubi Piso'),
                array( 'type' => 'text' ,  'val' => 'departamento_tipo_id', 'label' => 'Tipo'),
                array( 'type' => 'text' ,  'val' => 'terreno_area', 'label' => 'Terreno'),
                array( 'type' => 'text' ,  'val' => 'terreno_valorunitario', 'label' => 'Terreno Medida'),
                array( 'type' => 'text' ,  'val' => 'edificacion_area', 'label' => 'Area Edificacion'),
                array( 'type' => 'text' ,  'val' => 'valor_comercial', 'label' => 'Valor Comercial'),
                array( 'type' => 'ruta' ,  'val' => 'ruta_informe', 'label' => 'Ruta'),

            );
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }        
    }
    echo '</div>';
}
function imprimir_html_em($data, $categoria, $nodo,$first) {
    $display='display:none';
    
    if(is_array($data) and $first==true) {
        $display='display:block;';
    }
    echo '<div style="' . $display . '" class="menu-grilla-popup-item"
               id="menu-grilla-popup-item-' . $nodo . '">';
    if ( is_array($data) ) {
        echo '<table id="table1" class="" cellpadding="0" cellspacing="0">';
        if($categoria=='casa') {
            $l = array (
                array('label' => 'Ubicación'           , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (estudio)'     , 'type'=>'text' , 'val'=>'estudio_fecha'),
                array('label' => 'Terreno: Area'       , 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'float', 'val'=>'terreno_valorunitario'),
                array('label' => 'Terreno: Valor Unit.', 'type'=>'text', 'val'=>'terreno_valorunitario_uni'),
                array('label' => 'Valor Comercial'     , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Cant Pisos'          , 'type'=>'text', 'val'=>'piso_cantidad'),
                array('label' => 'Contacto'            , 'type'=>'text' , 'val'=>'contacto'),
                array('label' => 'Teléfono'            , 'type'=>'text' , 'val'=>'telefono'),
                array('label' => 'Zonificación'        , 'type'=>'text' , 'val'=>'zonificacion'),
            );
            foreach($data as $row) {
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='departamento') {
            $l = array (
                array('label' => 'Ubicación'            , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (estudio)'      , 'type'=>'text' , 'val'=>'estudio_fecha'),
                array('label' => 'Terreno: Area'        , 'type'=>'float', 'val'=>'terreno_area'),
                array('label' => 'Terreno: Valor Unit.' , 'type'=>'text', 'val'=>'terreno_valorunitario'),
                array('label' => 'Can Estacionam'       , 'type'=>'text' , 'val'=>'estacionamiento_cantidad'),
                array('label' => 'Tipo de Departam'     , 'type'=>'text' , 'val'=>'departamento_tipo'),
                array('label' => 'Areas Complement'     , 'type'=>'float', 'val'=>'areas_complementarias'),
                array('label' => 'Cant Pisos'           , 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Ubi Piso'             , 'type'=>'text' , 'val'=>'piso_ubicacion'),
                array('label' => 'Area Edificada'       , 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial'      , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Cant Pisos'           , 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Contacto'             , 'type'=>'text' , 'val'=>'contacto'),
                array('label' => 'Teléfono'             , 'type'=>'text' , 'val'=>'telefono'),
                array('label' => 'Zonificación'         , 'type'=>'text' , 'val'=>'zonificacion'),
            );
            foreach($data as $row) {
                $row['terreno_valorunitario'] = sprintf('%1.2f',  $row['terreno_valorunitario']) . ' ' . $row['terreno_valorunitario_uni'];
                $row['edificacion_area'] = sprintf('%1.2f',  $row['edificacion_area']) . ' ' . $row['edificacion_area_uni'];                
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '<table width="100%"></tr>';
            }
        }
        if($categoria=='local_comercial') {
            $l = array (
                array('label' => 'Ubicación'            , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (estudio)'      , 'type'=>'text' , 'val'=>'estudio_fecha'),
                array('label' => 'Terreno: Area'        , 'type'=>'float', 'val'=>'terreno_area'),                
                array('label' => 'Terreno: Valor Unit.' , 'type'=>'text', 'val'=>'terreno_valorunitario'),
                array('label' => 'Cant Pisos'           , 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Vista Lical'          , 'type'=>'text' , 'val'=>'vista_local'),
                array('label' => 'Area Edificada'       , 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial'      , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Contacto'             , 'type'=>'text' , 'val'=>'contacto'),
                array('label' => 'Teléfono'             , 'type'=>'text' , 'val'=>'telefono'),
                array('label' => 'Zonificación'         , 'type'=>'text' , 'val'=>'zonificacion'),
            );            
            foreach($data as $row) {
                $row['terreno_area'] = sprintf('%1.2f', $row['terreno_area']) . ' '. $row['terreno_area_uni'];
                $row['terreno_valorunitario'] = sprintf('%1.2f', $row['terreno_valorunitario']) . ' '. $row['terreno_valorunitario_uni'];
                $row['edificacion_area'] = sprintf('%1.2f', $row['edificacion_area']) . ' '. $row['edificacion_area_uni'];
                
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='local_industrial') {
            $l = array (
                array('label' => 'Ubicación'            , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (estudio)'      , 'type'=>'text' , 'val'=>'estudio_fecha'),
                array('label' => 'Terreno: Area'        , 'type'=>'float', 'val'=>'terreno_area'),                
                array('label' => 'Terreno: Valor Unit.' , 'type'=>'text', 'val'=>'terreno_valorunitario'),
                array('label' => 'Area Edificada'       , 'type'=>'float', 'val'=>'edificacion_area'),
                array('label' => 'Valor Comercial'      , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Cant Pisos'           , 'type'=>'float', 'val'=>'piso_cantidad'),
                array('label' => 'Contacto'             , 'type'=>'text' , 'val'=>'contacto'),
                array('label' => 'Teléfono'             , 'type'=>'text' , 'val'=>'telefono'),
                array('label' => 'Zonificación'         , 'type'=>'text' , 'val'=>'zonificacion'),
            );            
            foreach($data as $row) {
                $row['terreno_area'] = sprintf('%1.2f', $row['terreno_area']) . ' '. $row['terreno_area_uni'];
                $row['terreno_valorunitario'] = sprintf('%1.2f', $row['terreno_valorunitario']) . ' '. $row['terreno_valorunitario_uni'];
                $row['edificacion_area'] = sprintf('%1.2f', $row['edificacion_area']) . ' '. $row['edificacion_area_uni'];                

                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='terreno') {
            $l = array (
                array('label' => 'Ubicación'            , 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha (estudio)'      , 'type'=>'text' , 'val'=>'estudio_fecha'),
                array('label' => 'Terreno: Area'        , 'type'=>'float', 'val'=>'terreno_area'),                
                array('label' => 'Terreno: Valor Unit.' , 'type'=>'text', 'val'=>'terreno_valorunitario'),
                array('label' => 'Valor Comercial'      , 'type'=>'float', 'val'=>'valor_comercial'),
                array('label' => 'Contacto'             , 'type'=>'text' , 'val'=>'contacto'),
                array('label' => 'Teléfono'             , 'type'=>'text' , 'val'=>'telefono'),
                array('label' => 'Zonificación'         , 'type'=>'text' , 'val'=>'zonificacion'),
            );            
            foreach($data as $row) {
                $row['terreno_area'] = sprintf('%1.2f', $row['terreno_area']) . ' '. $row['terreno_area_uni'];
                $row['terreno_valorunitario'] = sprintf('%1.2f', $row['terreno_valorunitario']) . ' '. $row['terreno_valorunitario_uni'];
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }
        if($categoria=='oficina') {
            $l = array (
                array('label' => 'Ubicacion', 'type'=>'text' , 'val'=>'ubicacion'),
                array('label' => 'Fecha', 'type'=>'text' , 'val'=>'estudio_fecha'),
                array('label' => 'Terreno', 'type'=>'text' , 'val'=>'terreno_area'),
                array('label' => 'Valor Unitario', 'type'=>'text' , 'val'=>'terreno_valorunitario'),
                array('label' => 'Edificacion', 'type'=>'text' , 'val'=>'edificacion_area'),
                array('label' => 'Valor Unitario', 'type'=>'text' , 'val'=>'valor_comercial'),
                array('label' => 'Tipo', 'type'=>'text' , 'val'=>'departamento_tipo_id'),
                array('label' => 'Pisos', 'type'=>'text' , 'val'=>'piso_cantidad'),
                array('label' => 'Ubicacion Piso', 'type'=>'text' , 'val'=>'piso_ubicacion'),
                array('label' => 'Zonificacion', 'type'=>'text' , 'val'=>'zonificacion'),
                array('label' => 'Teléfono', 'type'=>'text' , 'val'=>'telefono'),
                array('label' => 'Contacto', 'type'=>'text' , 'val'=>'contacto'),

            );            
            foreach($data as $row) {
                $row['terreno_area'] = sprintf('%1.2f', $row['terreno_area']) . ' '. $row['terreno_area_uni'];
                $row['terreno_valorunitario'] = sprintf('%1.2f', $row['terreno_valorunitario']) . ' '. $row['terreno_valorunitario_uni'];
                echo '<tr><table width="100%">';
                imprimir_campo($l, $row);
                echo '</table></tr>';
            }
        }        
        echo '</table>';
        
    }
    echo '</div>';
}
function imprimir_campo($l, $d) {
    foreach ($l as $row) {
        if ($row['type'] == 'text')
            printf("<tr><th width='150'>%s</th><td>%s</td></tr>"
                   , $row['label']
                   , utf8_encode($d[$row['val']])
            );
        if ($row['type'] == 'float')
            printf("<tr><th width='150'>%s</th><td>%1.2f</td></tr>"
                   , $row['label']
                   , utf8_encode($d[$row['val']])
            );
        if ($row['type'] == 'ruta')
            printf("<tr><td colspan='2'><a href='#' class='button tiny no-margin right ruta' ruta='%s'>%s</td></tr>"
                   , utf8_encode($d[$row['val']])
                   , $row['label']
            );
    }
        
}
?>





<script>
 $(document).ready(function() {
     $('.menu-grilla-popup').on("click", 'a', function(e) {
	 var nodo = $(this).attr('nodo');
	 if (nodo !=0) {
	     $('.menu-grilla-popup li').removeClass('current');
	     $(this).parent().addClass('current');
	     $('.menu-grilla-popup-item').css('display','none');
	     $('#menu-grilla-popup-item-'+nodo).css('display','block');	
	 }

	 return false;
     });
     $('.menu-grilla-popup-item').on("click", 'a.ruta', function(e) {
	 var ruta = $(this).attr('ruta');
	 //window.open('./ajax/bat.php?ruta='+ruta);
	 prompt("Ruta", ruta);
	 return false;
     });

     $("#mm-popup").on('change', "#checkboxSwitch-popup", function() {
	 var estado = $(this).attr('estado');
	 if (estado=='t') {
	     $(this).attr('estado','em');
	     $('#menu-grilla-popup-t').hide();
	     $('#menu-grilla-popup-em').show();
	     $('#mensaje-checkboxSwitch-popup').text('Estudio de Mercado');
	 } else if (estado=='em') {
	     $(this).attr('estado','t');
	     $('#menu-grilla-popup-em').hide();
	     $('#menu-grilla-popup-t').show();
	     $('#mensaje-checkboxSwitch-popup').text('Tasación');
	 }
	 
     });

 });
</script>
