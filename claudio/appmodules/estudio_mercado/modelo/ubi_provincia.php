<?php
require_once '../config.php';
# IMPORTACION DE MODELO DE ABSTRACCION DE BD
require_once(RUTA.'sql/db_abstract_model.php');
# IMPORTACION DE LIBRERIAS


#DECLARACION DE LA CLASE
class UbiProvincia extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $provincia_id;
    public $nombre;

################################# MÉTODOS ##################################
# OBTENER DATOS DE UN provincia

    public function get($id = '') {
        $this->query = "
        select provincia_id, nombre
        from ubi_provincia where provincia_id = $id;";

        //print_r($this->query);
        //echo "<br><br>";
        
        $this->rows = null;
        $this->get_results_from_query();

        //print_r($this->rows);
        //echo "<br><br>";
        return $this->rows;
    }

# NUEVO provincia
    public function set($nuevo_provincia_data = array()) {             
        //FUNCION NO SOPORTADA
    }

# SACAR ID DEL ULTIMO provincia INSERTADO
    public function id_ultimo_provincia() {
        //FUNCION NO SOPORTADA
    }

# VERIFICAR EXISTENCIA DEL provincia
    public function buscar_o_insertar($id = '') {
        $data = $this->get($id);
        $nombre =  $data[0]['nombre'];
        $this->query = "select id, nombre from diccionario_ubi_provincia where nombre = '$nombre';";
        $this->rows = null;        
        $this->get_results_from_query();

        //print_r($this->rows);
        //echo "<br><br>";
        //die();

        if($this->rows != null){
            return $this->rows[0]['id'];
        }
        return -1;
    }

# BUSCAR O INSERTAR UN OBJETO
//    public function buscar_o_insertar($provincia_id = '') {
//        if($this->existe_provincia($provincia_id) < 0){
//            $nuevo_provincia_data = array('nombre' => $provincia_id);
//            $this->set($nuevo_provincia_data);
//            return $this->id_ultimo_provincia();
//        }
//        else{
//            return $this->existe_provincia($provincia_id);
//        }
//    }

# LISTADO DE provincia
    public function listar_provincias() {
        $this->query = "select * from t_terreno";
        $this->get_results_from_query();
        return $this->rows;
    }

# MODIFICAR provincia
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

# ELIMINAR provincia
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