<?php
require_once '../config.php';
# IMPORTACION DE MODELO DE ABSTRACCION DE BD
require_once(RUTA.'sql/db_abstract_model.php');
# IMPORTACION DE LIBRERIAS

#DECLARACION DE LA CLASE
class UbiDistrito extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $distrito_id;
    public $nombre;

################################# MÉTODOS ##################################
# OBTENER DATOS DE UN OBJETO

    public function get($id = '') {
        $this->query = "
        select distrito_id, nombre
        from ubi_distrito where distrito_id = $id;";

        //print_r($this->query);
        //echo "<br><br>";
        
        $this->rows = null;
        $this->get_results_from_query();

        //print_r($this->rows);
        //echo "<br><br>";
        return $this->rows;
    }

# NUEVO OBJETO
    public function set($nuevo_distrito_data = array()) {             
        //FUNCION NO SOPORTADA
    }

# SACAR ID DEL ULTIMO distrito INSERTADO
    public function id_ultimo_distrito() {
        //FUNCION NO SOPORTADA
    }

# VERIFICAR EXISTENCIA DEL distrito
    public function buscar_o_insertar($id = '') {
        $data = $this->get($id);
        $nombre =  $data[0]['nombre'];
        $this->query = "select id, nombre from diccionario_ubi_distrito where nombre = '$nombre';";
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
//    public function buscar_o_insertar($distrito_id = '') {
//        if($this->existe_distrito($distrito_id) < 0){
//            $nuevo_distrito_data = array('nombre' => $distrito_id);
//            $this->set($nuevo_distrito_data);
//            return $this->id_ultimo_distrito();
//        }
//        else{
//            return $this->existe_distrito($distrito_id);
//        }
//    }

# LISTADO DE OBJETO
    public function listar_distritos() {
        $this->query = "select * from ubi_distrito";
        $this->get_results_from_query();
        return $this->rows;
    }

# MODIFICAR OBJETO
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

# ELIMINAR OBJETO
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