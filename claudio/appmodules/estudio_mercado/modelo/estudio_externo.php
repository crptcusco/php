<?php
# Importar modelo de abstracción de base de datos
require_once(RUTA . 'sql/db_abstract_model.php');
require_once(RUTA . 'modelo/ubi_departamento.php');
require_once(RUTA . 'modelo/ubi_distrito.php');
require_once(RUTA . 'modelo/ubi_provincia.php');

class Estudio extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $consultor_id;
    public $ubicacion;
    public $ubi_departamento_id;
    public $ubi_provincia_id;
    public $ubi_distrito_id;
    public $estudio_fecha;
    public $terreno_area;
    public $terreno_valorunitario;
    public $valor_comercial;
    public $contacto;
    public $telefono;
    public $mapa_latitud;
    public $mapa_longitud;
    public $zonificacion;
    public $observacion;
    public $edificacion_area;
    public $piso_cantidad;
    public $estacionamiento_cantidad;
    public $departamento_tipo_id;
    public $areas_complementarias;
    public $proyecto_id;
    public $informe_id;
    public $piso_ubicacion;
    public $vista_local_id;
    public $tipo_propiedad;

################################# MÉTODOS ##################################
# Traer datos de un usuario

    public function get($user_email = '') {
        //funcion no soportada
    }

# Crear un nuevo estudio

    public function set($nuevo_estudio_data = array()) {

        foreach ($nuevo_estudio_data as $campo => $valor) {
            $$campo = utf8_decode($valor);
        }
        
        $this->query = "";

        switch ($categoria) {
            case 'em_departamento':
            $this->query = "
            INSERT INTO em_departamento (estudio_tipo_id, proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id, ubi_distrito_id,estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto, telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area, piso_cantidad,estacionamiento_cantidad,departamento_tipo_id,areas_complementarias, piso_ubicacion) VALUES('$estudio_tipo_id', '$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id', '$ubi_provincia_id',  '$ubi_distrito_id', STR_TO_DATE('$estudio_fecha','%Y-%m-%d'),'$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion','$edificacion_area','$piso_cantidad', '$estacionamiento_cantidad', '$departamento_tipo_id', '$areas_complementarias', '$piso_ubicacion')";
            break;
            case 'em_local_comercial':
            $this->query = "
            INSERT INTO em_local_comercial (estudio_tipo_id, proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id,estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto,telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area, piso_cantidad,vista_local_id) VALUES ('$estudio_tipo_id','$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', '$estudio_fecha','$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion','$edificacion_area', '$piso_cantidad','$vista_local_id')";
            break;
            case 'em_local_industrial':
            $this->query = "
            INSERT INTO em_local_industrial (estudio_tipo_id,proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id, estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto, telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area, piso_cantidad) VALUES('$estudio_tipo_id','$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id','$ubi_provincia_id', '$ubi_distrito_id', '$estudio_fecha','$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion','$edificacion_area', '$piso_cantidad')";
            break;
            case 'em_terreno':
            $this->query = "
            INSERT INTO em_terreno (estudio_tipo_id, proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id, estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto, telefono,mapa_latitud,mapa_longitud,zonificacion,observacion) VALUES ('$estudio_tipo_id','$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', STR_TO_DATE('$estudio_fecha','%Y-%m-%d'),'$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion')";
            break;
            case 'em_casa':
            $this->query = "
            INSERT INTO em_casa (estudio_tipo_id,proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id, estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto, telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area, piso_cantidad) VALUES('$estudio_tipo_id','$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', '$estudio_fecha','$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion','$edificacion_area', '$piso_cantidad')";

            break;
            case 'em_oficina':

            echo "ANTES de la Transformacion"."<br />";
            echo "Departamento : ".$ubi_departamento_id."<br />" ;
            echo "Provincia : ".$ubi_provincia_id."<br />" ;
            echo "Distrito : ".$ubi_distrito_id."<br />" ;

            echo "DESPUES de la Transformacion"."<br />";
            echo "Departamento : ".$ubi_departamento_id."<br />" ;
            echo "Provincia : ".$ubi_provincia_id."<br />" ;
            echo "Distrito : ".$ubi_distrito_id."<br />";

            echo "Tipo Propiedad: $tipo_propiedad <br />";
            echo strcmp ($tipo_propiedad , "EXCLUSIVA")."<br />";
            echo strcmp ($tipo_propiedad , "HORIZONTAL")."<br />";

            //die();

            if(strcmp($tipo_propiedad , "EXCLUSIVA") == 0 ){
                $this->query = "
                INSERT INTO em_oficina (estudio_tipo_id,proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id,ubi_distrito_id, estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto, telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area, piso_cantidad, tipo_propiedad  ) VALUES('$estudio_tipo_id','$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id','$ubi_provincia_id',  '$ubi_distrito_id', '$estudio_fecha','$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion','$edificacion_area', '$piso_cantidad', '$tipo_propiedad')";
            }
            elseif (strcmp($tipo_propiedad , "HORIZONTAL") == 0 ){
                $this->query = "
                INSERT INTO em_oficina (estudio_tipo_id, proyecto_id,informe_id,ubicacion, ubi_departamento_id,ubi_provincia_id, ubi_distrito_id,estudio_fecha,terreno_area,terreno_valorunitario,valor_comercial,contacto, telefono,mapa_latitud,mapa_longitud,zonificacion,observacion,edificacion_area, piso_cantidad,estacionamiento_cantidad,departamento_tipo_id,areas_complementarias, piso_ubicacion, tipo_propiedad) VALUES('$estudio_tipo_id', '$proyecto_id','$informe_id','$ubicacion', '$ubi_departamento_id', '$ubi_provincia_id', '$ubi_distrito_id', STR_TO_DATE('$estudio_fecha','%Y-%m-%d'),'$terreno_area', '$terreno_valorunitario', '$valor_comercial', '$contacto', '$telefono', '$mapa_latitud', '$mapa_longitud', '$zonificacion','$observacion','$edificacion_area','$piso_cantidad', '$estacionamiento_cantidad', '$departamento_tipo_id', '$areas_complementarias', '$piso_ubicacion', '$tipo_propiedad')";
            }else{
                $this->query = "";
                echo "Ha habido un problema en el tipo de Propiedad";
                die();
            }

            break;
            default:
            break;
        }
        echo $this->query;  
        //die();      
        $this->execute_single_query();
        
        $this->mensaje = 'Estudio Externo agregado exitosamente';
    }

//LISTADO DE ESTUDIOS EXTERNOS
    public function listar_estudios() {
//        $this->query = "select id,'CASA' as tipo,estudio_fecha,proyecto_id,informe_id,ubicacion,terreno_area, terreno_valorunitario,valor_comercial,zonificacion, observacion from em_casa 
//where consultor_id = $id              
//union select id,'DEPARTAMENTO'as tipo,estudio_fecha,proyecto_id,informe_id,ubicacion,terreno_area, terreno_valorunitario,valor_comercial,zonificacion, observacion from em_departamento
//where consultor_id = $id 
//union select id,'LOCAL COMERCIAL'as tipo,estudio_fecha,proyecto_id,informe_id,ubicacion,terreno_area, terreno_valorunitario,valor_comercial,zonificacion, observacion from em_local_comercial
//where consultor_id = $id 
//union select id,'LOCAL INDUSTRIAL'as tipo,estudio_fecha,proyecto_id,informe_id,ubicacion,terreno_area, terreno_valorunitario,valor_comercial,zonificacion, observacion from em_local_industrial
//where consultor_id = $id 
//union select id,'TERRENO'as tipo,estudio_fecha,proyecto_id,informe_id,ubicacion,terreno_area, terreno_valorunitario,valor_comercial,zonificacion, observacion from em_terreno
//where consultor_id = $id 
//order by estudio_fecha desc limit 100; ";

        $this->query = "
        select emca.id as id,'CASA' as tipo,
        estudio_fecha as fecha,
        proyecto_id as proyecto,
        informe_id as informe,
        ubidep.nombre as departamento,
        ubipro.nombre as provincia,
        ubidis.nombre as distrito,
        ubicacion as ubicacion,
        terreno_area as terreno,
        terreno_valorunitario as valorunitario,
        valor_comercial as valorcomercial,
        zonificacion as zonificacion,
        observacion as observacion
        from em_casa as emca
        inner join diccionario_ubi_departamento as ubidep on emca.ubi_departamento_id = ubidep.id
        inner join diccionario_ubi_provincia as ubipro on emca.ubi_provincia_id = ubipro.id
        inner join diccionario_ubi_distrito as ubidis on emca.ubi_distrito_id = ubidis.id
        union select emde.id as id,'DEPARTAMENTO' as tipo,
        estudio_fecha as fecha,
        proyecto_id as proyecto,
        informe_id as informe,
        ubidep.nombre as departamento,
        ubipro.nombre as provincia,
        ubidis.nombre as distrito,
        ubicacion as ubicacion,
        terreno_area as terreno,
        terreno_valorunitario as valorunitario,
        valor_comercial as valorcomercial,
        zonificacion as zonificacion,
        observacion as observacion
        from em_departamento as emde
        inner join diccionario_ubi_departamento as ubidep on emde.ubi_departamento_id = ubidep.id
        inner join diccionario_ubi_provincia as ubipro on emde.ubi_provincia_id = ubipro.id
        inner join diccionario_ubi_distrito as ubidis on emde.ubi_distrito_id = ubidis.id
        union select emloco.id as id,'LOCAL_COMERCIAL' as tipo,
        estudio_fecha as fecha,
        proyecto_id as proyecto,
        informe_id as informe,
        ubidep.nombre as departamento,
        ubipro.nombre as provincia,
        ubidis.nombre as distrito,
        ubicacion as ubicacion,
        terreno_area as terreno,
        terreno_valorunitario as valorunitario,
        valor_comercial as valorcomercial,
        zonificacion as zonificacion,
        observacion as observacion
        from em_local_comercial emloco
        inner join diccionario_ubi_departamento as ubidep on emloco.ubi_departamento_id = ubidep.id
        inner join diccionario_ubi_provincia as ubipro on emloco.ubi_provincia_id = ubipro.id
        inner join diccionario_ubi_distrito as ubidis on emloco.ubi_distrito_id = ubidis.id
        union select emloin.id as id,'LOCAL_INDUSTRIAL' as tipo,
        estudio_fecha as fecha,
        proyecto_id as proyecto,
        informe_id as informe,
        ubidep.nombre as departamento,
        ubipro.nombre as provincia,
        ubidis.nombre as distrito,
        ubicacion as ubicacion,
        terreno_area as terreno,
        terreno_valorunitario as valorunitario,
        valor_comercial as valorcomercial,
        zonificacion as zonificacion,
        observacion as observacion
        from em_local_industrial emloin
        inner join diccionario_ubi_departamento as ubidep on emloin.ubi_departamento_id = ubidep.id
        inner join diccionario_ubi_provincia as ubipro on emloin.ubi_provincia_id = ubipro.id
        inner join diccionario_ubi_distrito as ubidis on emloin.ubi_distrito_id = ubidis.id
        union select emofic.id as id,'OFICINA' as tipo,
        estudio_fecha as fecha,
        proyecto_id as proyecto,
        informe_id as informe,
        ubidep.nombre as departamento,
        ubipro.nombre as provincia,
        ubidis.nombre as distrito,
        ubicacion as ubicacion,
        terreno_area as terreno,
        terreno_valorunitario as valorunitario,
        valor_comercial as valorcomercial,
        zonificacion as zonificacion,
        observacion as observacion
        from em_oficina emofic
        inner join diccionario_ubi_departamento as ubidep on emofic.ubi_departamento_id = ubidep.id
        inner join diccionario_ubi_provincia as ubipro on emofic.ubi_provincia_id = ubipro.id
        inner join diccionario_ubi_distrito as ubidis on emofic.ubi_distrito_id = ubidis.id
        union select emte.id as id,'TERRENO' as tipo,
        estudio_fecha as fecha,
        proyecto_id as proyecto,
        informe_id as informe,
        ubidep.nombre as departamento,
        ubipro.nombre as provincia,
        ubidis.nombre as distrito,
        ubicacion as ubicacion,
        terreno_area as terreno,
        terreno_valorunitario as valorunitario,
        valor_comercial as valorcomercial,
        zonificacion as zonificacion, 
        observacion as observacion
        from em_terreno emte
        inner join diccionario_ubi_departamento as ubidep on emte.ubi_departamento_id = ubidep.id
        inner join diccionario_ubi_provincia as ubipro on emte.ubi_provincia_id = ubipro.id
        inner join diccionario_ubi_distrito as ubidis on emte.ubi_distrito_id = ubidis.id
        order by fecha desc;";

//        echo $this->query;
//        die();     

        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

    //LISTADO DE ESTUDIOS EXTERNOS
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
        $this->query = "select nombre,detalle  from in_zonificacion";
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
    public function delete($id = '', $tipo = '') {
        switch ($tipo) {
            case 'DEPARTAMENTO':
            $this->query = "DELETE FROM em_departamento WHERE id = $id";
            break;
            case 'LOCAL_COMERCIAL':
            $this->query = "DELETE FROM em_local_comercial WHERE id = $id";
            break;
            case 'LOCAL_INDUSTRIAL':
            $this->query = "DELETE FROM em_local_industrial WHERE id = $id";
            break;
            case 'TERRENO':
            $this->query = "DELETE FROM em_terreno WHERE id = $id";
            break;
            case 'CASA':
            $this->query = "DELETE FROM em_casa WHERE id = $id";
            break;
            case 'OFICINA':
            $this->query = "DELETE FROM em_oficina WHERE id = $id";
            break;
            default:
            break;
        }
        $this->execute_single_query();
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
