<?php
require_once '../config.php';
# IMPORTACION DE MODELO DE ABSTRACCION DE BD
require_once(RUTA.'sql/db_abstract_model.php');
# IMPORTACION DE LIBRERIAS


#DECLARACION DE LA CLASE
class UbiDepartamento extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $departamento_id;
    public $nombre;

################################# MÉTODOS ##################################
# OBTENER DATOS DE UN departamento

    public function get($id = '') {
        $this->query = "
        select departamento_id, nombre
        from ubi_departamento where departamento_id = $id;";

        //print_r($this->query);
        //echo "<br><br>";
        
        $this->rows = null;
        $this->get_results_from_query();

        //print_r($this->rows);
        //echo "<br><br>";
        return $this->rows;
    }

# NUEVO departamento
    public function set($nuevo_departamento_data = array()) {             
        //FUNCION NO SOPORTADA
    }

# SACAR ID DEL ULTIMO departamento INSERTADO
    public function id_ultimo_departamento() {
        //FUNCION NO SOPORTADA
    }
# BUSCAR NOMBRE DE DEPARTAMENTO

# VERIFICAR EXISTENCIA DEL DEPARTAMENTO
    public function buscar_o_insertar($id = '') {
        $data = $this->get($id);
        $nombre =  $data[0]['nombre'];
        $this->query = "select id, nombre from diccionario_ubi_departamento where nombre = '$nombre';";
        $this->rows = null;        
        $this->get_results_from_query();

        //print_r($this->rows);
        //echo "<br><br>";

        if($this->rows != null){
            return $this->rows[0]['id'];
        }
        return -1;
    }

# BUSCAR O INSERTAR UN OBJETO
//    public function buscar_o_insertar($departamento_id = '') {
//        if($this->existe_departamento($departamento_id) < 0){
//            $nuevo_departamento_data = array('nombre' => $departamento_id);
//            $this->set($nuevo_departamento_data);
//            return $this->id_ultimo_departamento();
//        }
//        else{
//            return $this->existe_departamento($departamento_id);
//        }
//    }

# LISTADO DE DEPARTAMENTO
    public function listar_departamentos() {
        $this->query = "select * from t_terreno";
        $this->get_results_from_query();
        return $this->rows;
    }

# MODIFICAR departamento
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

# ELIMINAR departamento
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