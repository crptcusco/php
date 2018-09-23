<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once(RUTA.'modelo/model_cliente.php');

//require_once(RUTA.'model_cliente.php');
//require_once('model_solicitante.php');
//require_once('model_propietario.php');

class Terreno extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;
    public $cliente_id;
    public $propietario_id;
    public $solicitante_id;
    public $ubicacion;
    public $tasacion_fecha;
    public $ubi_departamento_id;
    public $ubi_provincia_id;
    public $ubi_distrito_id;
    public $mapa_latitud;
    public $mapa_longitud;
    public $zonificacion;
    public $cultivo_tipo_id;
    public $terreno_area;
    public $terreno_valorunitario;
    public $valor_comercial;
    public $tipo_cambio;
    public $observacion;
    public $ruta_informe;

################################# MÉTODOS ##################################
# Traer datos de un terreno

    public function get($id = '') {
        //funcion no soportada
        $this->query = "
        select id,proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, ubi_departamento_id, ubi_provincia_id, ubi_provincia_id,
        ubi_distrito_id, mapa_latitud, mapa_longitud, zonificacion, cultivo_tipo_id,
        terreno_area, terreno_valorunitario, valor_comercial, tipo_cambio, observacion, ruta_informe 
        from t_terreno where id = $id;";
        
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# Crear un nuevo terreno
    public function set($nuevo_terreno_data = array()) {             
        
        foreach ($nuevo_estudio_data as $campo => $valor) {
            $$campo = $valor;
        }
        //VALIDACION DE CLIENTE EXISTENTE



        //INSERCION DE DATOS
        $this->query = "
        INSERT INTO em_terreno (id,proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, ubi_departamento_id, ubi_provincia_id, ubi_provincia_id,
        ubi_distrito_id, mapa_latitud, mapa_longitud, zonificacion, cultivo_tipo_id,
        terreno_area, terreno_valorunitario, valor_comercial, tipo_cambio, observacion, ruta_informe 
        from t_terreno)
        VALUES('$id', '$proyecto_id','$informe_id','$cliente_id',$proyecto_id, $solicitante_id,
        $ubicacion,STR_TO_DATE('$tasacion_fecha','%Y-%m-%d'), $ubi_departamento_id, $ubi_provincia_id,
        $ubi_distrito_id, mapa_latitud, mapa_longitud, $zonificacion, $cultivo_tipo_id, $terreno_area,
        $terreno_valorunitario, $valor_comercial, $tipo_cambio, $observacion, $ruta_informe);";

        $this->execute_single_query();
        $this->mensaje = 'Estudio Externo agregado exitosamente';
    }

//LISTADO DE ESTUDIOS EXTERNOS
    public function listar_terrenos() {
        $this->query = "select * from t_terreno     
        ";
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