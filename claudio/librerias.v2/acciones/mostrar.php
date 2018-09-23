<?php

function get_id_tienda_by_usuario($usuario){
    $id_tienda=0;
        $sql = "
            SELECT t.`idtienda`
            FROM `usuario` u
            JOIN `tienda` t ON t.`idtienda`=u.`idtienda`
            WHERE 
            u.`idusuario`=?
            ";
    
    $data = array("i", "{$usuario}");
    $fields = array("id" => ""); // el formato de como se muestra

    DBConnector::$results = null;
    DBConnector::ejecutar($sql, $data, $fields);
    $id_tienda= DBConnector::$results;
    $id_tienda = $id_tienda[0]['id'];
    //printr(DBConnector::$results); //para mostrar
    return $id_tienda;
}