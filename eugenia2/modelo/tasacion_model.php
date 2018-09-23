<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once(RUTA.'sql/db_abstract_model.php');

class Tasacion extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $ubicacion;
    public $ubi_departamento_id;
    public $ubi_provincia_id;
    public $ubi_distrito_id;
    public $estudio_fecha;
    public $terreno_area;
    public $terreno_valorunitario;


################################# MÉTODOS ##################################
# Traer datos de un usuario

    public function get($coordinacion = '') {
        //funcion no soportada
        $this->query = "
        select cotizacion_correlativo COORDINACION,
DATE_FORMAT(coor_coordinacion.info_create, '%d/%m/%y')  FECHA, 
login1.full_name PERITO, 
login2.full_name CONTROL_CALIDAD, 
if(coor_coordinacion.solicitante_persona_tipo like 'Natural' ,coinna2.nombre,coinju2.nombre) as SOLICITANTE, 
if(coor_coordinacion.cliente_persona_tipo like 'Natural' ,coinna.nombre,coinju.nombre) as CLIENTE  
 from coor_coordinacion 
left join coor_inspeccion as coorin on 
coor_coordinacion.id = coorin.coordinacion_id 
left join login_user as login1 on  
login1.id =  coorin.perito_id 
left join login_user as login2 on  
login2.id =  coorin.inspector_id 
left join co_involucrado_juridica as coinju on 
coor_coordinacion.cliente_persona_id = coinju.id 
left join co_involucrado_natural as coinna on 
coor_coordinacion.cliente_persona_id = coinna.id 
left join co_involucrado_juridica as coinju2 on 
coor_coordinacion.solicitante_persona_id = coinju2.id 
left join co_involucrado_natural as coinna2 on 
coor_coordinacion.solicitante_persona_id = coinna2.id 
where not exists (select 1 from t_terreno  
where t_terreno.informe_id = coor_coordinacion.cotizacion_correlativo) and cotizacion_correlativo = $coordinacion 
order by PERITO DESC ;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
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
    public function listar_tasaciones_pendientes() {
        $this->query = "
        select cotizacion_correlativo COORDINACION,
DATE_FORMAT(coor_coordinacion.info_create, '%d/%m/%y')  FECHA, 
login1.full_name PERITO, 
login2.full_name CONTROL_CALIDAD, 
if(coor_coordinacion.solicitante_persona_tipo like 'Natural' ,coinna2.nombre,coinju2.nombre) as SOLICITANTE, 
if(coor_coordinacion.cliente_persona_tipo like 'Natural' ,coinna.nombre,coinju.nombre) as CLIENTE  
 from coor_coordinacion 
left join coor_inspeccion as coorin on 
coor_coordinacion.id = coorin.coordinacion_id 
left join login_user as login1 on  
login1.id =  coorin.perito_id 
left join login_user as login2 on  
login2.id =  coorin.inspector_id 
left join co_involucrado_juridica as coinju on 
coor_coordinacion.cliente_persona_id = coinju.id 
left join co_involucrado_natural as coinna on 
coor_coordinacion.cliente_persona_id = coinna.id 
left join co_involucrado_juridica as coinju2 on 
coor_coordinacion.solicitante_persona_id = coinju2.id 
left join co_involucrado_natural as coinna2 on 
coor_coordinacion.solicitante_persona_id = coinna2.id 
where not exists (select 1 from t_terreno  
where t_terreno.informe_id = coor_coordinacion.cotizacion_correlativo) 
order by PERITO DESC ;";
// printf($this->query);
// die();
        $this->get_results_from_query();
        return $this->rows;
    }
    
    //LISTADO DE COMBOS
    public function listar_departamentos() {
        $this->query = "select departamento_id,nombre from ubi_departamento order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_provincias($id) {
        $this->query = "select provincia_id,nombre, departamento_id from ubi_provincia where departamento_id=$id order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_distritos($id) {
        $this->query = "select distrito_id,nombre, provincia_id from ubi_distrito where provincia_id=$id order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }
    
    public function listar_zonificacion() {
        $this->query = "select nombre,detalle  from tzonificacion";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_cultivos() {
        $this->query = "select id,nombre from diccionario_cultivo_tipo";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_vista() {
        $this->query = "select id,nombre  from diccionario_vista_local";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function listar_tipo_departamento() {
        $this->query = "select id,nombre  from diccionario_departamento_tipo";
        $this->rows = null;
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
        $this->db_name = 'cotiza_factura';
    }
# Método destructor del objeto
    function __destruct() {
        unset($this);
    }
}
?>