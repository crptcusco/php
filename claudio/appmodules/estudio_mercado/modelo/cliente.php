<?php
require_once '../config.php';
# IMPORTACION DE MODELO DE ABSTRACCION DE BD
require_once(RUTA.'sql/db_abstract_model.php');
# IMPORTACION DE LIBRERIAS


#DECLARACION DE LA CLASE
class Cliente extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;

################################# MÉTODOS ##################################
# OBTENER DATOS DE UN CLIENTE

    public function get($id = '') {
        $this->query = "
        select id, nombre, sinonimo
        from diccionario_cliente where id = $id;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# NUEVO CLIENTE
    public function set($nuevo_cliente_data = array()) {             
        foreach ($nuevo_cliente_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
        INSERT INTO diccionario_cliente (nombre, sinonimo )
        VALUES('$nombre',0);";        
        $this->execute_single_query();
        $this->mensaje = 'Cliente nuevo agregado exitosamente';
        return $this->id_ultimo_cliente();
    }

# SACAR ID DEL ULTIMO CLIENTE INSERTADO
    public function id_ultimo_cliente() {
        $this->query = "SELECT MAX(id) AS id FROM diccionario_cliente";
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];
        }
        return 0;
    }

# VERIFICAR EXISTENCIA DEL CLIENTE
    public function existe_cliente($nombre = '') {
        $this->query = "select * from diccionario_cliente where nombre like '$nombre';";
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];
        }
        return -1;
    }

# BUSCAR O INSERTAR UN CLIENTE
    public function buscar_o_insertar($cliente_id = '') {
        if($this->existe_cliente($cliente_id) < 0){
            $nuevo_cliente_data = array('nombre' => $cliente_id);
            $this->set($nuevo_cliente_data);
            return $this->id_ultimo_cliente();
        }
        else{
            return $this->existe_cliente($cliente_id);
        }
    }

# LISTADO DE CLIENTES
    public function listar_clientes() {
        $this->query = "select * from diccionario_cliente";
        $this->get_results_from_query();
        return $this->rows;
    }
    

# MODIFICAR CLIENTE
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

# ELIMINAR CLIENTE
    public function delete($user_email = '') {
        $this->query = "
        DELETE FROM usuarios
        WHERE email = '$user_email'
        ";
        $this->execute_single_query();
        $this->mensaje = 'Usuario eliminado';
    }

# METODO CONSTRUCTOR DEL OBJETO
    function __construct() {
        $this->db_name = 'cotiza_factura';
    }

# METODO DESTRUCTOR DEL OBJETO
    function __destruct() {
        unset($this);
    }
}
?>
