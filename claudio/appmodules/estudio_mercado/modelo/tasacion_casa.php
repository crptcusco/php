<?php
# IMPORTANCIONES
require_once RUTA.'sql/db_abstract_model.php';
require_once RUTA.'modelo/cliente.php';
require_once RUTA.'modelo/solicitante.php';
require_once RUTA.'modelo/propietario.php';

require_once RUTA.'modelo/ubi_departamento.php';
require_once RUTA.'modelo/ubi_provincia.php';
require_once RUTA.'modelo/ubi_distrito.php';

class Casa extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;
    public $cliente_id;
    public $propietario_id;
    public $solicitante_id;
    public $ubicacion;
    public $tasacion_fecha;
    public $ubi_departamento_id;
    public $ubi_provincia_id;
    public $ubi_distrito_id;
    public $mapa_latitud;
    public $mapa_longitud;
    public $zonificacion;
    public $piso_cantidad;
    public $terreno_area;
    public $terreno_valorunitario;
    public $edificacion_area;
    public $valor_comercial;
    public $areas_complementarias;
    public $tipo_cambio;
    public $observacion;
    public $ruta_informe;
    public $usuario_registro_id;

################################# MÉTODOS ##################################

# OBTENER OBJETO
    public function get($id = '') {
        //funcion no soportada
        $this->query = "
        select id,proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, ubi_departamento_id, ubi_provincia_id, ubi_provincia_id,
        ubi_distrito_id, mapa_latitud, mapa_longitud, zonificacion, piso_cantidad,
        terreno_area, terreno_valorunitario, edificacion_area ,valor_comercial, areas_complementarias ,
        tipo_cambio, observacion, ruta_informe 
        from t_casa where id = $id;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# INSERTAR OBJETO
    public function set($nueva_casa_data = array()) {             

        foreach ($nueva_casa_data as $campo => $valor) {
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
        INSERT INTO t_casa (proyecto_id,informe_id,cliente_id,propietario_id,solicitante_id,
        ubicacion, tasacion_fecha, ubi_departamento_id, ubi_provincia_id,
        ubi_distrito_id, mapa_latitud, mapa_longitud, zonificacion, piso_cantidad,
        terreno_area, terreno_valorunitario, edificacion_area ,valor_comercial, areas_complementarias ,
        tipo_cambio, observacion, ruta_informe, usuario_registro_id,fecha_registro)
        VALUES('$proyecto_id','$informe_id','$cliente_id_bd','$propietario_id_bd', '$solicitante_id_bd',
        '$ubicacion',STR_TO_DATE('$tasacion_fecha','%Y-%m-%d'), '$ubi_departamento_id', '$ubi_provincia_id',
        '$ubi_distrito_id','$mapa_latitud','$mapa_longitud','$zonificacion','$piso_cantidad',
        '$terreno_area','$terreno_valorunitario','$edificacion_area','$valor_comercial','$areas_complementarias',
        '$tipo_cambio','$observacion','$ruta_informe','$usuario_registro_id',NOW());";
        $this->execute_single_query();
        $this->mensaje = 'Tasacion de Casa agregada exitosamente';
    }

#FUNCIONES
    public function listar_casas() {
        $this->query = "select * from t_casa ";
        $this->get_results_from_query();
        return $this->rows;
    }

#MODIFICAR OBJETO
    public function edit($user_data = array()) {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
        UPDATE casas
        SET nombre='$nombre',
        apellido='$apellido'
        WHERE email = '$email'
        ";
        $this->execute_single_query();
        $this->mensaje = 'casa modificado';
    }

#ELIMINAR OBJETO
    public function delete($user_email = '') {
        $this->query = "
        DELETE FROM t_casa
        WHERE email = '$user_email'
        ";
        $this->execute_single_query();
        $this->mensaje = 'casa eliminado';
    }

#METODO CONSTRUCTOR
    function __construct() {
        $this->db_name = 'cotiza_factura';
    }

#METODO DESTRUCTOR
    function __destruct() {
        unset($this);
    }
}
?>