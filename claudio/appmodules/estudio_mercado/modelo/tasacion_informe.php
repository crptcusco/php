<?php
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

public function set($nuevo_estudio_data = array()) {             
    //FUNCION NO SOPORTADA
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
       where not exists (select 1 from t_terreno where t_terreno.informe_id = coor_coordinacion.cotizacion_correlativo) 
       and  not exists (select 1 from t_casa where t_casa.informe_id = coor_coordinacion.cotizacion_correlativo)
       and  not exists (select 1 from t_departamento where t_departamento.informe_id = coor_coordinacion.cotizacion_correlativo)
       and  not exists (select 1 from t_local_comercial where t_local_comercial.informe_id = coor_coordinacion.cotizacion_correlativo)
       and  not exists (select 1 from t_local_industrial where t_local_industrial.informe_id = coor_coordinacion.cotizacion_correlativo)
       and  not exists (select 1 from t_local_comercial where t_local_comercial.informe_id = coor_coordinacion.cotizacion_correlativo)
       and  not exists (select 1 from t_maquinaria where t_maquinaria.informe_id = coor_coordinacion.cotizacion_correlativo)
       and  not exists (select 1 from t_vehiculo where t_vehiculo.informe_id = coor_coordinacion.cotizacion_correlativo) 
       and  not exists (select 1 from in_no_registrado where in_no_registrado.informe_id = coor_coordinacion.cotizacion_correlativo) 
       order by PERITO DESC ;";
         //echo ($this->query);
         //die();
       $this->get_results_from_query();
       return $this->rows;
   }
   public function listar_cantidad_tasaciones_perito() {
    $this->query = "
    select fuente.usuario_registro_id, lu.full_name nombre, count(fuente.usuario_registro_id) as cantidad from (
        select id,usuario_registro_id from t_casa union  
        select id,usuario_registro_id from t_departamento union  
        select id,usuario_registro_id from t_local_comercial union  
        select id,usuario_registro_id from t_local_industrial union  
        select id,usuario_registro_id from t_maquinaria union  
        select id,usuario_registro_id from t_terreno union  
        select id,usuario_registro_id from t_vehiculo union
        select id,usuario_registro_id from in_no_registrado ) as fuente 
        inner join login_user lu on lu.id = fuente.usuario_registro_id 
        group by (fuente.usuario_registro_id);";
$this->rows = null;
$this->get_results_from_query();
return $this->rows;
}   

public function listar_cantidad_tasaciones_semanal() {
    $this->query = "
    select fuente.usuario_registro_id, lu.full_name nombre, count(fuente.usuario_registro_id) as cantidad from (
        select id,usuario_registro_id,fecha_registro from t_casa union  
        select id,usuario_registro_id,fecha_registro from t_departamento union  
        select id,usuario_registro_id,fecha_registro from t_local_comercial union  
        select id,usuario_registro_id,fecha_registro from t_local_industrial union  
        select id,usuario_registro_id,fecha_registro from t_maquinaria union  
        select id,usuario_registro_id,fecha_registro from t_terreno union  
        select id,usuario_registro_id,fecha_registro from t_vehiculo union
        select id,usuario_registro_id,fecha_registro from in_no_registrado ) as fuente 
        inner join login_user lu on lu.id = fuente.usuario_registro_id 
        where fuente.fecha_registro <= now() and fuente.fecha_registro >= date_add(NOW(), INTERVAL -9 DAY)
        group by (fuente.usuario_registro_id);";
$this->rows = null;
$this->get_results_from_query();
return $this->rows;
}

public function listar_cantidad_tasaciones_hoy() {
    $this->query = "
    select fuente.usuario_registro_id, lu.full_name nombre, count(fuente.usuario_registro_id) as cantidad from (
        select id,usuario_registro_id,fecha_registro from t_casa union  
        select id,usuario_registro_id,fecha_registro from t_departamento union  
        select id,usuario_registro_id,fecha_registro from t_local_comercial union  
        select id,usuario_registro_id,fecha_registro from t_local_industrial union  
        select id,usuario_registro_id,fecha_registro from t_maquinaria union  
        select id,usuario_registro_id,fecha_registro from t_terreno union  
        select id,usuario_registro_id,fecha_registro from t_vehiculo union
        select id,usuario_registro_id,fecha_registro from in_no_registrado ) as fuente 
        inner join login_user lu on lu.id = fuente.usuario_registro_id 
        where LEFT(fuente.fecha_registro,10)=CURDATE() 
        group by (fuente.usuario_registro_id);";
$this->rows = null;
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
    $this->query = "select provincia_id,nombre from ubi_provincia where departamento_id=$id order by nombre;";
    $this->rows = null;
    $this->get_results_from_query();
    return $this->rows;
}

public function listar_distritos($id) {
    $this->query = "select distrito_id,nombre from ubi_distrito where provincia_id=$id order by nombre;";
    $this->rows = null;
    $this->get_results_from_query();
    return $this->rows;
}

public function listar_zonificacion() {
    $this->query = "select id,nombre,detalle from in_zonificacion";
    $this->get_results_from_query();
    return $this->rows;
}


public function listar_usuario_registra() {
    $this->query = "select lg.id, lg.full_name from coor_rol_has_user crhu
    inner join login_user lg on lg.id = crhu.user_id 
    inner join coor_rol cr on cr.id = crhu.rol_id 
    where cr.id = 2;";
    $this->get_results_from_query();
    return $this->rows;
}

public function listar_tipo_cultivo() {
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

#GUARDAR DICCIONARIO
public function guardar_tipo_cultivo($in) {
    $this->query = "INSERT INTO diccionario_cultivo_tipo SET nombre = '{$in['nombre']}';";
    $this->execute_single_query();
}

#VERIFICAR EXISTENCIA
public function existe_tipo_cultivo($in) {
    $this->query = "SELECT * FROM diccionario_cultivo_tipo
    WHERE nombre = '{$in['nombre']}' LIMIT 1; ";
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