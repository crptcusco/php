<?php
# Importar modelo de abstracción de base de date_offset_get()
require_once(RUTA.'sql/db_abstract_model.php');     

class Maquinaria extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $estudio_tipo_id;
    public $proyecto_id;
    public $informe_id;
    public $ubicacion;
    public $estudio_fecha;
    public $maquinaria_tipo_id;
    public $maquinaria_marca_id;
    public $maquinaria_modelo_id;
    public $fabricacion_anio;
    public $valor_similar_nuevo;
    public $contacto;
    public $telefono;
    public $observacion;
    public $ruta_informe;

################################# MÉTODOS ##################################
# Traer datos de un usuario

    public function get($id = '') {
        //funcion no soportada
    }

# Crear un nuevo maquinaria
    public function set($nuevo_maquinaria_data = array()) {

        foreach ($nuevo_maquinaria_data as $campo => $valor) {
            $$campo = utf8_decode($valor);
        }
        $this->query = "
        INSERT INTO em_maquinaria ( estudio_tipo_id, proyecto_id, informe_id, ubicacion, estudio_fecha, maquinaria_tipo_id, 
        maquinaria_marca_id, maquinaria_modelo_id, fabricacion_anio, valor_similar_nuevo, contacto, 
        telefono, observacion, ruta_informe)
        VALUES('$estudio_tipo_id', '$proyecto_id', '$informe_id', '$ubicacion', '$estudio_fecha', '$maquinaria_tipo_id', 
        '$maquinaria_marca_id', '$maquinaria_modelo_id', '$fabricacion_anio', '$valor_similar_nuevo', 
        '$contacto', '$telefono','$observacion', '$ruta_informe')";
        
        //echo $this->query;        
        //die();

        $this->execute_single_query();
        $this->mensaje = 'Estudio de maquinaria agregado exitosamente';
    }

//LISTADO DE maquinariaS EXTERNOS
    public function listar_maquinarias() {

        $this->query = "
        select emma.id, emma.estudio_tipo_id, emma.proyecto_id, emma.ubicacion UBICACION ,
        emma.contacto CONTACTO, emma.telefono TELEFONO, 
        emma.observacion OBSERVACION, emma.ruta_informe,
        emma.informe_id COORDINACION, 
        emma.estudio_fecha FECHA,
        dimati.nombre TIPO,
        dimama.nombre MARCA,
        dimamo.nombre MODELO, 
        emma.fabricacion_anio FABRICACION_ANIO,
        emma.valor_similar_nuevo VALOR_NUEVO
        from em_maquinaria emma
        inner join diccionario_maquinaria_marca dimama 
        on dimama.id= emma.maquinaria_marca_id
        inner join diccionario_maquinaria_modelo dimamo 
        on dimamo.id= emma.maquinaria_modelo_id
        inner join diccionario_maquinaria_tipo dimati 
        on dimati.id= emma.maquinaria_tipo_id
        order by emma.estudio_fecha desc limit 50;
        ;";
        
//        echo $this->query;
//        die();     
        
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }
    
    //LISTADO DE maquinariaS EXTERNOS
    public function listar_maquinaria_tipo() {
        $this->query = "select * from diccionario_maquinaria_tipo order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_maquinaria_marca() {
        $this->query = "select * from diccionario_maquinaria_marca order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_maquinaria_modelo() {
        $this->query = "select * from diccionario_maquinaria_modelo order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function listar_maquinaria_traccion() {
        $this->query = "select * from diccionario_maquinaria_traccion order by nombre;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function existe_maquinaria_tipo($in) {
        $this->query = "SELECT * FROM diccionario_maquinaria_tipo
                        WHERE nombre = '{$in['nombre']}' LIMIT 1;
                        ";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function existe_maquinaria_marca($in) {
        $this->query = "SELECT * FROM diccionario_maquinaria_marca
                        WHERE nombre = '{$in['nombre']}' LIMIT 1;
                        ";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function existe_maquinaria_modelo($in) {
        $this->query = "SELECT * FROM diccionario_maquinaria_modelo
                        WHERE nombre = '{$in['nombre']}' LIMIT 1;
                        ";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function existe_maquinaria_traccion($in) {
        $this->query = "SELECT * FROM diccionario_maquinaria_traccion
                        WHERE nombre = '{$in['nombre']}' LIMIT 1;
                        ";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function guardar_maquinaria_tipo($in) {
        $this->query = "INSERT INTO diccionario_maquinaria_tipo SET nombre = '{$in['nombre']}';";
    $this->execute_single_query();
    }

    public function guardar_maquinaria_marca($in) {
        $this->query = "INSERT INTO diccionario_maquinaria_marca SET nombre = '{$in['nombre']}';";
    $this->execute_single_query();
    }

    public function guardar_maquinaria_modelo($in) {
        $this->query = "INSERT INTO diccionario_maquinaria_modelo SET nombre = '{$in['nombre']}';";
    $this->execute_single_query();
    }

    public function guardar_maquinaria_traccion($in) {
        $this->query = "INSERT INTO diccionario_maquinaria_traccion SET nombre = '{$in['nombre']}';";
    $this->execute_single_query();
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
# Eliminar una maquinaria
public function delete($id = '') {
    $this->query = "
    DELETE FROM em_maquinaria
    WHERE id = $id";
    $this->execute_single_query();
    $this->mensaje = 'Maquinaria eliminada';
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
