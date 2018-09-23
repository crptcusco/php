<?php

# Importar modelo de abstracción de base de datos
require_once RUTA.'sql/db_abstract_model.php';
require_once RUTA.'modelo/cliente.php';
require_once RUTA.'modelo/solicitante.php';
require_once RUTA.'modelo/propietario.php';

class Vehiculo extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;
    public $cliente_id;
    public $propietario_id;
    public $solicitante_id;
    public $ubicacion;
    public $tasacion_fecha;
    public $vehiculo_tipo_id;
    public $vehiculo_marca_id;
    public $vehiculo_modelo_id;
    public $fabricacion_anio;
    public $vehiculo_traccion_id;
    public $valor_similar_nuevo;
    public $valor_comercial;
    public $tipo_cambio;
    public $usuario_registro_id;
    public $observacion;
    public $ruta_informe;

################################# MÉTODOS ##################################
# Traer datos de un terreno

    public function get($id = '') {
        //funcion no soportada
        $this->query = "
        select id,proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, vehiculo_tipo_id, vehiculo_marca_id, vehiculo_modelo_id,
        fabricacion_anio, vehiculo_traccion_id, valor_similar_nuevo, valor_comercial, tipo_cambio, observacion, ruta_informe 
        from t_terreno where id = $id;";
        
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# NUEVO TERRENO
    public function set($nuevo_terreno_data = array()) {             

        foreach ($nuevo_terreno_data as $campo => $valor) {
            $$campo = $valor;
        }
        
        //REFACTORIZACION DE CLIENTE
        $cliente = new Cliente();
        $cliente_id_bd = $cliente->buscar_o_insertar($cliente_id);

        //REFACTORIZACION DE PROPIETARIO
        $propietario = new Propietario();
        $propietario_id_bd = $propietario->buscar_o_insertar($propietario_id);

        //REFACTORIZACION DE SOLICITANTE
        $solicitante = new Solicitante();
        $solicitante_id_bd = $solicitante->buscar_o_insertar($solicitante_id);

        //INSERCION DE DATOS
        $this->query = "
        INSERT INTO t_vehiculo (proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, vehiculo_tipo_id, vehiculo_marca_id, vehiculo_modelo_id,fabricacion_anio,
        vehiculo_traccion_id, valor_similar_nuevo, valor_comercial, tipo_cambio, observacion, ruta_informe ,usuario_registro_id,fecha_registro)
        VALUES('$proyecto_id','$informe_id','$cliente_id_bd','$propietario_id_bd', '$solicitante_id_bd',
        '$ubicacion',STR_TO_DATE('$tasacion_fecha','%Y-%m-%d'), '$vehiculo_tipo_id','$vehiculo_marca_id' ,
        '$vehiculo_modelo_id','$fabricacion_anio','$vehiculo_traccion_id','$valor_similar_nuevo',
        '$valor_comercial','$tipo_cambio','$observacion','$ruta_informe','$usuario_registro_id',NOW());";

        //print_r($this->query);
        //die();

        $this->execute_single_query();
        $this->mensaje = 'Estudio Externo agregado exitosamente';
    }

//LISTADO DE ESTUDIOS EXTERNOS
    public function listar_terrenos() {
        $this->query = "select * from t_terreno ";
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