<?php

# Importar modelo de abstracción de base de datos
require_once('db_abstract_model.php');

include "../../../librerias.v2/mysql/dbconnector.php";
require_once('db_abstract_model.php');

class Cotizacion extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;

################################# MÉTODOS ##################################
# Traer datos de un usuario

    public function get($user_email = '') {
        //funcion no soportada
    }

# Crear un nuevo estudio

    public function set($nuevo_estudio_data = array()) {
        foreach ($nuevo_estudio_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "";
        switch ($categoria) {
            case 'em_departamento':
                $this->query = "
INSERT INTO em_departamento (ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id,
estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto,
telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area,
piso_cantidad,estacionamiento_cantidad,departamento_tipo_id,areas_complementarias,
piso_ubicacion)
VALUES('$ubicacion', '$ubi_departamento_id', '$ubi_provincia_id',  '$ubi_distrito_id',
STR_TO_DATE('$estudio_fecha','%Y-%m-%d'),$terreno_area, $terreno_valorunitario, $valor_comercial, '$contacto',
'$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion',$edificacion_area,
$piso_cantidad, $estacionamiento_cantidad, '$departamento_tipo_id', '$areas_complementarias',
$piso_ubicacion)";
                break;
            case 'em_local_comercial':
                $this->query = "
INSERT INTO em_local_comercial (ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id,
STR_TO_DATE('$estudio_fecha'),'%Y-%m-%d'),terreno_area,terreno_valorunitario,valor_comercial,contacto,
telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area,
piso_cantidad,vista_local_id)
VALUES('$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', 
'$estudio_fecha',$terreno_area, $terreno_valorunitario, $valor_comercial, '$contacto',
'$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion',$edificacion_area,
$piso_cantidad,'$vista_local_id')";
                break;
            case 'em_local_industrial':
                $this->query = "
INSERT INTO em_local_industrial (ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id,
estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto,
telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area,
piso_cantidad)
VALUES('$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', 
'$estudio_fecha',$terreno_area, $terreno_valorunitario, $valor_comercial, '$contacto',
'$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion',$edificacion_area,
$piso_cantidad)";
                break;
            case 'em_terreno':
                $this->query = "
INSERT INTO em_terreno (ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id,
estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto,
telefono,mapa_latitud,mapa_longitud,zonificacion,observacion)
VALUES('$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', 
STR_TO_DATE('$estudio_fecha','%Y-%m-%d'),$terreno_area, $terreno_valorunitario, $valor_comercial, '$contacto',
'$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion')";
                break;
            case 'em_casa':
                $this->query = "
INSERT INTO em_casa (ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id,
estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto,
telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area,
piso_cantidad)
VALUES('$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', 
'$estudio_fecha',$terreno_area, $terreno_valorunitario, $valor_comercial, '$contacto',
'$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion',$edificacion_area,
$piso_cantidad)";

                break;
            default:
                break;
        }
        $this->execute_single_query();
        $this->mensaje = 'Estudio Externo agregado exitosamente';
    }

    //LISTADO DE ESTUDIOS EXTERNOS
    public function mostrar_cotizacion($codigo) {
        $this->query = "select coco.fecha_envio_cliente as fecha,
coco.id as id,
coco.codigo as codigo,
cocoti.id as tipo,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado,
if(coin.contacto_id=0,'PERSONA NATURAL',coinco.cargo) as cargo,
cose.nombre as servicio,
cose.id as servicio_id,
copa.total_monto as monto,
copa.total_monto_igv as monto_igv,
como.nombre as moneda,
como.simbolo as simbolo,
codes.nombre as desglose,
lous.email as email
from co_cotizacion as coco
inner join login_user as lous on lous.id = coco.info_create_user
inner join co_involucrado as coin on coco.id = coin.cotizacion_id
left join co_involucrado_juridica as coinju on coinju.id = coin.persona_id
left join co_involucrado_natural as coinna on coinna.id=coin.persona_id
left join co_involucrado_contacto as coinco on coinco.id=coin.contacto_id
inner join co_servicio_tipo as cose on coco.servicio_tipo_id = cose.id
inner join co_pago as copa on coco.id = copa.cotizacion_id
inner join co_cotizacion_tipo as cocoti on cocoti.id = coco.tipo_cotizacion_id
inner join co_moneda as como on como.id = copa.total_moneda_id
inner join co_desglose as codes on codes.id = coco.desglose_id
where coco.codigo = $codigo and coin.rol_id=1;";
        $this->rows = null;
        
//        print_r($this->query);
//        die();

        $this->get_results_from_query();
        return $this->rows;
    }

    public function mostrar_items_cotizacion($id) {
        $this->query = "
        SELECT s.descripcion descr, CONCAT(m.simbolo, ' ', FORMAT(s.subtotal, 2)) as subtotal FROM `co_servicio` s
        LEFT JOIN co_pago p ON p.cotizacion_id = s.cotizacion_id
        LEFT JOIN co_moneda m ON m.id = p.total_moneda_id
        WHERE s.cotizacion_id= '$id'
        ";
        $this->rows = null;
        //        print_r($this->query);
        //        die();
        $this->get_results_from_query();

        return $this->rows;
    }

    public function mostrar_items_requerimientos($tipo) {
        $this->query = '
        SELECT nombre FROM `co_requisito` 
        WHERE servicio_tipo_id = ' . $tipo . '
        ';
        // echo $this->query;
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }
    
    public function mostrar_requisitos_cotizacion($servicio_id) {
        $this->query = "select id,nombre from co_requisito where servicio_tipo_id = $servicio_id;";
        $this->rows = null;
//        print_r($this->query);
//        die();
        $this->get_results_from_query();
        return $this->rows;
    }

# Modificar un usuario

    public function edit($user_data = array()) {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
UPDATE usuarios
SET nombre='$nombre',
apellido='$apellido'
WHERE email = '$email'
";
        $this->execute_single_query();
        $this->mensaje = 'Usuario modificado';
    }

# Eliminar un usuario

    public function delete($user_email = '') {
        $this->query = "
DELETE FROM usuarios
WHERE email = '$user_email'
";
        $this->execute_single_query();
        $this->mensaje = 'Usuario eliminado';
    }

# Método constructor

    function __construct() {
        $obj = new DBConnector_Alternative();
        $this->db_host = $obj->servername;
        $this->db_user = $obj->username;
        $this->db_pass = $obj->password;
        $this->db_name = $obj->dbname;
    }

# Método destructor del objeto

    function __destruct() {
        unset($this);
    }

}