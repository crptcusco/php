<?php
require_once '../config.php';
# IMPORTACION DE MODELO DE ABSTRACCION DE BD
require_once(RUTA.'sql/db_abstract_model.php');
# IMPORTACION DE LIBRERIAS


#DECLARACION DE LA CLASE
class Propietario extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;

################################# MÉTODOS ##################################
# OBTENER DATOS DE UN propietario

    public function get($id = '') {
        $this->query = "
        select id, nombre, sinonimo
        from diccionario_propietario where id = $id;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# NUEVO propietario
    public function set($nuevo_propietario_data = array()) {             
        foreach ($nuevo_propietario_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
        INSERT INTO diccionario_propietario (nombre, sinonimo )
        VALUES('$nombre',0);";        
        $this->execute_single_query();

        $this->mensaje = 'propietario nuevo agregado exitosamente';

        return $this->id_ultimo_propietario();
    }

# SACAR ID DEL ULTIMO propietario INSERTADO
    public function id_ultimo_propietario() {
        $this->query = "SELECT MAX(id) AS id FROM diccionario_propietario";
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];
        }
        return 0;
    }

# VERIFICAR EXISTENCIA DEL propietario
    public function existe_propietario($nombre = '') {
        $this->query = "select * from diccionario_propietario where nombre like '$nombre';";
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];
        }
        return -1;
    }

# BUSCAR O INSERTAR UN OBJETO
    public function buscar_o_insertar($propietario_id = '') {
        if($this->existe_propietario($propietario_id) < 0){
            $nuevo_propietario_data = array('nombre' => $propietario_id);
            $this->set($nuevo_propietario_data);
            return $this->id_ultimo_propietario();
        }
        else{
            return $this->existe_propietario($propietario_id);
        }
    }

# LISTADO DE propietarioS
    public function listar_propietarios() {
        $this->query = "select * from t_terreno";
        $this->get_results_from_query();
        return $this->rows;
    }
    

# MODIFICAR propietario
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

# ELIMINAR propietario
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
