<?php
require_once '../config.php';
require_once( RUTA.'sql/db_abstract_model.php');

class VehiculoTipo extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $nombre;
    public $sinonimo;

################################# MÉTODOS ##################################
# Traer datos de un terreno

    public function get($id = '') {
        //funcion no soportada
        $this->query = "
        select id, nombre, sinonimo
        from diccionario_vehiculo_tipo where id = $id;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# Crear un nuevo terreno
    public function set($nombre = '') {             
        $this->query = "
        INSERT INTO diccionario_vehiculo_tipo (nombre)
        VALUES('$nombre');";        
        $this->execute_single_query();
        $this->mensaje = 'Tipo de Vehiculo nuevo agregado exitosamente';
        //return $ultimo_vehiculo_tipo_id = id_ultimo_tipo_vehiculo;
    }
//SACAR ID DEL ULTIMO CLIENTE INSERTADO
    public function id_ultimo_tipo_vehiculo() {
        $this->query = "SELECT MAX(id) AS id FROM diccionario_vehiculo_tipo";     
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];    
        }
        return 0;
    }

// Verificar si ya se tiene creado ese vehiculo_tipo
    public function existe_vehiculo_tipo($nombre = '') {
        $this->query = "select * from diccionario_vehiculo_tipo where nombre like '$nombre';";     
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];    
        }
        return -1;
    }

//LISTADO DE CLIENTES
    public function listar_vehiculo_tipo() {
        $this->query = "select id,nombre from diccionario_vehiculo_tipo";
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
