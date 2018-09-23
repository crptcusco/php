<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/html/tabla.php";

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$cnn= new DBConnector_Alternative();
$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());


$sql = '
SELECT rol_id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . ' LIMIT 1'
;
$query=mysqli_query($conn, $sql) or die("00");
$data = mysqli_fetch_array($query);
$filter = '';
if ( $data['rol_id'] != 2 ) {
	$filter = ' AND v.user_id=' . $_SESSION['user_id'];
}

$sql_ini = '
   SELECT 
     p.codigo
   , v.nombre vendedor_nombre
   , j.nombre persona_nombre
   , e.nombre estado_nombre
   , c.nombre contacto_nombre
   , c.cargo contacto_cargo
   , DATE_FORMAT(p.fecha, "%d-%m-%Y") fecha
   , p.hora
   , p.minuto
   -- oculto
   , p.id
   FROM ve_propuesta p
   LEFT JOIN co_involucrado_juridica j ON j.id=p.persona_id
   LEFT JOIN co_vendedor v ON v.id=p.vendedor_id
   LEFT JOIN ve_estado e ON e.id=p.estado_id
   LEFT JOIN co_involucrado_contacto c ON c.id=p.contacto_id
   WHERE codigo!=0 AND p.persona_tipo="Juridica" AND p.info_status!=0 ' . $filter . '
UNION
   SELECT
     p.codigo
   , v.nombre vendedor_nombre
   , n.nombre persona_nombre
   , e.nombre estado_nombre
   , c.nombre contacto_nombre
   , c.cargo contacto_cargo
   , DATE_FORMAT(p.fecha, "%d-%m-%Y") fecha
   , p.hora
   , p.minuto
   -- oculto
   , p.id
   FROM ve_propuesta p
   LEFT JOIN co_involucrado_natural n ON n.id=p.persona_id
   LEFT JOIN co_vendedor v ON v.id=p.vendedor_id
   LEFT JOIN ve_estado e ON e.id=p.estado_id
   LEFT JOIN co_involucrado_contacto c ON c.id=p.contacto_id
   WHERE codigo!=0 AND p.persona_tipo="Natural" AND p.info_status!=0 ' . $filter . '
';

$sql_donde = '
SELECT unido.id FROM (' . $sql_ini . ' ORDER BY ' . (intval($requestData['order'][0]['column'])+1) . ') unido
WHERE 1=1
';

$sql_ini = '
SELECT unido.* FROM (' . $sql_ini . ') unido
WHERE 1=1 
';

$sql = $sql_ini;
// echo $sql;
// getting total number records without any search
$query=mysqli_query($conn, $sql) or die("01");


$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;


$i = -1;
$sql_filter = '';
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND codigo LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND vendedor_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND persona_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value'])  . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND estado_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND contacto_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND contacto_cargo LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND fecha LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}

++$i; // coordinaciones

$sql .= $sql_filter;
$sql_donde .= $sql_filter;
// print ($sql);

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' ) {    
    $query=mysqli_query($conn, $sql_donde) or die("02.5");
    $pagina = 0;
    while( $row=mysqli_fetch_array($query) ) {
        $pagina +=1;
        if ($requestData['search']['value'] == $row['id']) break;
    }
    if ($pagina > 1) {
        $pagina -=1;
    }
    $pagina = $pagina - ($pagina % $requestData['length']);

    $requestData['start'] = $pagina;
} else {
    $pagina = 0;
}

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */


$query=mysqli_query($conn, $sql) or die("03");
// esto es para decir cuando no se puede $editar

$data = array();

while( $row=mysqli_fetch_array($query) ) {
    $row['hora-minuto'] =  de_militar_a_meridiano( $row['hora'], $row['minuto'] );
    
    $nestedData = array();
    
    $nestedData[] =  '<a href="./editar.php?codigo=' . $row['codigo'] . '" 
                         target="propuesta_item">'.
                         $row['codigo'].
                     '</a>';
    $nestedData[] = utf8_encode( strtoupper( $row['vendedor_nombre'] ) );
    $nestedData[] = utf8_encode( strtoupper( $row['persona_nombre'] ) );
    $nestedData[] = utf8_encode( strtoupper( $row['estado_nombre'] ) );
    $nestedData[] = utf8_encode( strtoupper( $row['contacto_nombre'] ) );
    $nestedData[] = utf8_encode( strtoupper( $row['contacto_cargo'] ) );
    $nestedData[] = $row['fecha'];
    $nestedData[] = strtoupper( $row['hora-minuto'] );
    $nestedData[] = '<a class="delete" 
                               style="color:red"
                               propuesta_id="' . $row['id'] . '"
                     >Eliminar
                     </a>';    
    $data[] = $nestedData;
}


$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
    // , "pagina"          => $pagina
);

echo json_encode($json_data);  // send data as json format

