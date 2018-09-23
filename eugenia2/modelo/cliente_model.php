<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once(RUTA.'sql/db_abstract_model.php');

class Cliente extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;

################################# MÉTODOS ##################################
# Traer datos de un terreno

    public function get($id = '') {
        //funcion no soportada
        $this->query = "
        select id, nombre, sinonimo
        from diccionario_cliente where id = $id;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# Crear un nuevo terreno
    public function set($nuevo_cliente_data = array()) {             
        foreach ($nuevo_cliente_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
        INSERT INTO diccionario_cliente (id, nombre, sinonimo )
        VALUES('$id','$nombre','$sinonimo');";        
        
        $this->execute_single_query();
        $this->mensaje = 'Cliente nuevo agregado exitosamente';

        return $ultimo_cliente_id;
        
        
    }
//SACAR ID DEL ULTIMO CLIENTE INSERTADO
    public function id_ultimo_cliente() {
        $this->query = "SELECT MAX(id) AS id FROM diccionario_cliente";     
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];    
        }
        return 0;
    }

// Verificar si ya se tiene creado ese cliente
    public function existe_cliente($nombre = '') {
        $this->query = "select * from diccionario_cliente where nombre like '$nombre';";     
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];    
        }
        return -1;
    }

//LISTADO DE CLIENTES
    public function listar_clientes() {
        $this->query = "select * from t_terreno";
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
