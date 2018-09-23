<style>
 .table_data td {
     padding: 0;
 }
 .table_data td input.active,
 .table_data td select.active
 {
     background-color: #aefcd1;
 }
 
 
</style>
<?php

$col['casa']['t'] = array(
    array('label'=>'Cliente'             , 'type' => 'text'),
    array('label'=>'Propietario'         , 'type' => 'text'),
    array('label'=>'Solicitante'         , 'type' => 'text'),
    array('label'=>'Ubicacion'           , 'type' => 'text'),
    array('label'=>'Fecha (Tasacion)'    , 'type' => 'text'),
    array('label'=>'Zonificación'        , 'type' => 'text'),
    array('label'=>'Nro Pisos'           , 'type' => 'text'),
    array('label'=>'Terreno: Area'       , 'type' => 'text'),
    array('label'=>'Terreno: Valor Unit.', 'type' => 'text'),
    array('label'=>'Edificacion: Area'   , 'type' => 'text'),
    array('label'=>'Valor Comercial'     , 'type' => 'text'),
    array('label'=>'Ruta'                , 'type' => 'ruta'),
);
$col['departamento']['t'] = array(
    array('label'=>'Cliente'             , 'type' => 'text'),
    array('label'=>'Propietario'         , 'type' => 'text'),
    array('label'=>'Solicitante'         , 'type' => 'text'),
    array('label'=>'Ubicacion'           , 'type' => 'text'),
    array('label'=>'Fecha (Tasacion)'    , 'type' => 'text'),
    array('label'=>'Zonificación'        , 'type' => 'text'),
    array('label'=>'Nro Pisos'           , 'type' => 'text'),
    array('label'=>'Ubi Pisos'           , 'type' => 'text'),
    array('label'=>'Depart amento (Tipo)', 'type' => 'text'),
    array('label'=>'Terreno: Area'       , 'type' => 'text'),
    array('label'=>'Terreno: Valor Unit.', 'type' => 'text'),
    array('label'=>'Edificacion: Area'   , 'type' => 'text'),
    array('label'=>'Valor Comercial'     , 'type' => 'text'),
    array('label'=>'Valor Ocupada'       , 'type' => 'text'),
    array('label'=>'Estacionamientos'    , 'type' => 'text'),
    array('label'=>'Ruta'                , 'type' => 'ruta'),
);
$col['local_industrial']['t'] = array(
    array('label'=>'Cliente'              , 'type' => 'text'),
    array('label'=>'Propietario'          , 'type' => 'text'),
    array('label'=>'Solicitante'          , 'type' => 'text'),
    array('label'=>'Ubicacion'            , 'type' => 'text'),
    array('label'=>'Fecha (Tasacion)'     , 'type' => 'text'),
    array('label'=>'Zonifica ción'        , 'type' => 'text'),
    array('label'=>'Nro Pisos'            , 'type' => 'text'),
    array('label'=>'Terreno: Area'        , 'type' => 'text'),
    array('label'=>'Terreno: Valor Unit.' , 'type' => 'text'),
    array('label'=>'Edificacion: Area'    , 'type' => 'text'),
    array('label'=>'Valor Comercial'      , 'type' => 'text'),
    array('label'=>'Areas Comple mentaria', 'type' => 'text'),
    array('label'=>'Ruta'                 , 'type' => 'ruta'),
);
$col['local_comercial']['t'] = array(
    array('label'=>'Cliente'             , 'type' => 'text'),
    array('label'=>'Propietario'         , 'type' => 'text'),
    array('label'=>'Solicitante'         , 'type' => 'text'),
    array('label'=>'Ubicacion'           , 'type' => 'text'),
    array('label'=>'Fecha (Tasacion)'    , 'type' => 'text'),
    array('label'=>'Zonificación'        , 'type' => 'text'),
    array('label'=>'Nro Pisos'           , 'type' => 'text'),
    array('label'=>'Vista de local'      , 'type' => 'text'),
    array('label'=>'Terreno: Area'       , 'type' => 'text'),
    array('label'=>'Terreno: Valor Unit.', 'type' => 'text'),
    array('label'=>'Edificacion: Area'   , 'type' => 'text'),
    array('label'=>'Valor Comercial'     , 'type' => 'text'),
    array('label'=>'Valor Ocupa pada'    , 'type' => 'text'),
    array('label'=>'Ruta'                , 'type' => 'ruta'),
    
);
$col['terreno']['t'] = array(
    array('label'=>'Cliente'             , 'type' => 'text'),
    array('label'=>'Propietario'         , 'type' => 'text'),
    array('label'=>'Solicitante'         , 'type' => 'text'),
    array('label'=>'Ubicacion'           , 'type' => 'text'),
    array('label'=>'Fecha (Tasacion)'    , 'type' => 'text'),
    array('label'=>'Zonificación'        , 'type' => 'text'),
    array('label'=>'Cultivo tipo'        , 'type' => 'text'),
    array('label'=>'Terreno: Area'       , 'type' => 'text'),
    array('label'=>'Terreno: Valor Unit.', 'type' => 'text'),
    array('label'=>'Valor Comercial'     , 'type' => 'text'),
    array('label'=>'Ruta'                , 'type' => 'ruta'),    
);
$col['oficina']['t'] = array(
    array('label'=>'Cliente'             , 'type' => 'text'),
    array('label'=>'Propietario'         , 'type' => 'text'),
    array('label'=>'Solicitante'         , 'type' => 'text'),
    array('label'=>'Ubicacion'           , 'type' => 'text'),
    array('label'=>'Fecha (Tasacion)'    , 'type' => 'text'),
    array('label'=>'Zonificación'        , 'type' => 'text'),

    array('label'=>'Pisos'               , 'type' => 'text'),
    array('label'=>'Piso Ubicacion'      , 'type' => 'text'),
    array('label'=>'Tipo Departamento'   , 'type' => 'text'),

    array('label'=>'Terreno: Area'       , 'type' => 'text'),
    array('label'=>'Terreno: Valor Unit.', 'type' => 'text'),
    array('label'=>'Area Edificación'    , 'type' => 'text'),
    array('label'=>'Valor Comercial'     , 'type' => 'text'),
    array('label'=>'Ruta'                , 'type' => 'ruta'),    
);
$col['casa']['em'] = array(
    array('label'=>'Ubicación'           , 'type' => 'text'),
    array('label'=>'Estudio Fecha'       , 'type' => 'text'),
    array('label'=>'Area Terreno'        , 'type' => 'text'),
    array('label'=>'Med'                 , 'type' => 'text'),
    array('label'=>'Valor Unitario Terr.', 'type' => 'text'),
    array('label'=>'Med'                 , 'type' => 'text'),
    array('label'=>'Edificacion'         , 'type' => 'text'),
    array('label'=>'Med'                 , 'type' => 'text'),
    array('label'=>'Valor Comercial'     , 'type' => 'text'),
    array('label'=>'Pisos'               , 'type' => 'text'),
    array('label'=>'Contacto'            , 'type' => 'text'),
    array('label'=>'Teléfono'            , 'type' => 'text'),
    array('label'=>'Zonificación'        , 'type' => 'text'),
    array('label'=>'Ruta'                , 'type' => 'text'),
);
$col['departamento']['em'] = array(
    array('label'=>'Ubicación'            , 'type' => 'text'),
    array('label'=>'Estudio Fecha'        , 'type' => 'text'),
    array('label'=>'Area Terreno'         , 'type' => 'text'),
    array('label'=>'Med'                  , 'type' => 'text'),
    array('label'=>'Valor Unitar Terr.'   , 'type' => 'text'),
    array('label'=>'Med'                  , 'type' => 'text'),
    array('label'=>'Estacion amiento'     , 'type' => 'text'),
    array('label'=>'Tipo'                 , 'type' => 'text'),
    array('label'=>'Areas Complementarias', 'type' => 'text'),
    array('label'=>'Pisos'                , 'type' => 'text'),
    array('label'=>'Pisos Ubi.'           , 'type' => 'text'),
    array('label'=>'Edificacion'          , 'type' => 'text'),
    array('label'=>'Med'                  , 'type' => 'text'),
    array('label'=>'Valor Comercial'      , 'type' => 'text'),
    array('label'=>'Contacto'             , 'type' => 'text'),
    array('label'=>'Teléfono'             , 'type' => 'text'),
    array('label'=>'Zonificación'         , 'type' => 'text'),
    array('label'=>'Ruta'                 , 'type' => 'ruta'),    
);
$col['local_industrial']['em'] = array(
    array('label'=>'Ubicación'         , 'type' => 'text'),
    array('label'=>'Estudio Fecha'     , 'type' => 'text'),
    array('label'=>'Area Terreno'      , 'type' => 'text'),
    array('label'=>'Med'               , 'type' => 'text'),
    array('label'=>'Valor Unitar Terr.', 'type' => 'text'),
    array('label'=>'Med'               , 'type' => 'text'),
    array('label'=>'Area Edificacion'  , 'type' => 'text'),
    array('label'=>'Med'               , 'type' => 'text'),
    array('label'=>'Valor Comercial'   , 'type' => 'text'),
    array('label'=>'Pisos'             , 'type' => 'text'),
    array('label'=>'Contacto'          , 'type' => 'text'),
    array('label'=>'Teléfono'          , 'type' => 'text'),
    array('label'=>'Zonificación'      , 'type' => 'text'),
    array('label'=>'Ruta'              , 'type' => 'ruta'),
);
$col['local_comercial']['em'] = array(
    array('label'=>'Ubicación'         , 'type' => 'text'),
    array('label'=>'Estudio Fecha'     , 'type' => 'text'),
    array('label'=>'Area Terreno'      , 'type' => 'text'),
    array('label'=>'Med'               , 'type' => 'text'),
    array('label'=>'Valor Unitar Terr.', 'type' => 'text'),
    array('label'=>'Med'               , 'type' => 'text'),
    array('label'=>'Pisos'             , 'type' => 'text'),
    array('label'=>'Vista Local'       , 'type' => 'text'),
    array('label'=>'Area Edificacion'  , 'type' => 'text'),
    array('label'=>'Med'               , 'type' => 'text'),
    array('label'=>'Valor Comercial'   , 'type' => 'text'),
    array('label'=>'Contacto'          , 'type' => 'text'),
    array('label'=>'Teléfono'          , 'type' => 'text'),
    array('label'=>'Zonificación'      , 'type' => 'text'),
    array('label'=>'Ruta'              , 'type' => 'ruta'),
    
);
$col['terreno']['em'] = array(
    array('label'=>'Ubicación'          , 'type' => 'text'),
    array('label'=>'Estudio Fecha'      , 'type' => 'text'),
    array('label'=>'Area Terreno'       , 'type' => 'text'),
    array('label'=>'Med'                , 'type' => 'text'),
    array('label'=>'Valor Unitar Terr.' , 'type' => 'text'),
    array('label'=>'Med'                , 'type' => 'text'),
    array('label'=>'Valor Comercial'    , 'type' => 'text'),
    array('label'=>'Contacto'           , 'type' => 'text'),
    array('label'=>'Teléfono'           , 'type' => 'text'),
    array('label'=>'Zonificación'       , 'type' => 'text'),
    array('label'=>'Ruta'              , 'type' => 'ruta'),
);

$col['oficina']['em'] = array(
    array('label'=>'Ubicación'          , 'type' => 'text'),
    array('label'=>'Estudio Fecha'      , 'type' => 'text'),

    array('label'=>'Area Terreno'       , 'type' => 'text'),
    array('label'=>'Med'                , 'type' => 'text'),    
    array('label'=>'Valor Unitar Terr.' , 'type' => 'text'),
    array('label'=>'Med'                , 'type' => 'text'),
    array('label'=>'Area Edificacion'   , 'type' => 'text'),
    array('label'=>'Med'                , 'type' => 'text'),
    array('label'=>'Valor Comercial'    , 'type' => 'text'),
    
    array('label'=>'Tipo Departamento'  , 'type' => 'text'),
    array('label'=>'Pisos'              , 'type' => 'text'),
    array('label'=>'Piso Ubicacion'     , 'type' => 'text'),

    array('label'=>'Contacto'           , 'type' => 'text'),
    array('label'=>'Teléfono'           , 'type' => 'text'),
    array('label'=>'Zonificación'       , 'type' => 'text'),
    array('label'=>'Ruta'              , 'type' => 'ruta'),
);
foreach (array('casa' => 'Casa',
               'departamento' => 'Departamento',
               'local_comercial' => 'Local Comercial',
               'local_industrial'=>'Local Industrial',
               'terreno' =>'Terreno',
               'oficina' => 'Oficina', ) as $key1 => $row1) {
    foreach (array('t' => 'Tasaciones de ','em' => 'Estudios de Mercado de ') as $key2 => $row2) {
        if(isset($col[$key1][$key2])) {
            echo '<div id="table_' . $key1 . '_' . $key2 . '_div" class="table_data" style="display: none;">';
            echo '<table id="table_' . $key1 . '_' . $key2 . '">';
            echo '<caption>' . $row2 . $row1 . '</caption>';
            echo '<thead>';
            echo '<tr>';
            $i = 0;
            foreach ($col[$key1][$key2] as $row3) {
                echo '<td>';
                if ($row3['type'] == 'text') {
                    echo '<input class="no-margin search-input-text" type="text" data-column="' . ++$i . '">';
                }
                echo '</td>';
            }
            echo '</tr>';
            echo '<tr>';
            
            foreach ($col[$key1][$key2] as $row3) {
                echo '<td>';
                echo $row3['label'];
                echo '</td>';
            }
            echo '</tr>';
            echo '</head>';
            echo '</table>';
            echo '</div>';
        }
    }

}
