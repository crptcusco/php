<?php

# Importar modelo de abstracción de base de datos
require_once RUTA.'sql/db_abstract_model.php';

class NoRegistrado extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;
    public $tasacion_fecha;
    public $observacion;

################################# MÉTODOS ##################################
# Traer datos de un terreno

    public function get($id = '') {
        //funcion no soportada
        $this->query = "select id,proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, ubi_departamento_id, ubi_provincia_id, ubi_provincia_id,
        ubi_distrito_id, mapa_latitud, mapa_longitud, zonificacion, cultivo_tipo_id,
        terreno_area, terreno_valorunitario, valor_comercial, tipo_cambio, observacion, ruta_informe 
        from t_terreno where id = $id;";
        
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# NUEVO TERRENO
    public function set($nuevo_no_registrado_data = array()) {

        foreach ($nuevo_no_registrado_data as $campo => $valor) {
            $$campo = $valor;
        }

        //INSERCION DE DATOS
        $this->query = "INSERT INTO in_no_registrado (proyecto_id,informe_id, tasacion_fecha, observacion,usuario_registro_id,fecha_registro) VALUES('$proyecto_id','$informe_id', STR_TO_DATE('$tasacion_fecha','%Y-%m-%d'),'$observacion','$usuario_registro_id',NOW());";

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