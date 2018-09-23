<?php
// ---------------------------------------------- ini-libs
include ("../html/etiquetas.php");
include('../mysql/dbconnector.php');

class Query {

    public $fields = NULL;
    public $sql;
    public $data = NULL;

    public function exe() {
        DBConnector::set_db('ella');
        DBConnector::$results = NULL;
        if ($this->fields == NULL) {
            DBConnector::ejecutar($this->sql, $this->data);
        } else {
            DBConnector::ejecutar($this->sql, $this->data, $this->fields);
        }

        return DBConnector::$results;
    }

}

$q = new Query();

function mostrar_tablas() {
    global $q;
    $q->fields = array(
        "name" => ""
    );
    $q->sql = "
           SHOW TABLES
           ";
    $q->data;
    return $q->exe();
}

function count_table($name) {
    global $q;
    $q->fields = array(
        "count" => ""
    );
    $q->sql = "
           SELECT COUNT(*) FROM " . $name
    ;
    $q->data = NULL;
    return $q->exe()[0]['count'];
}

function insert_productos($count) {
    global $q;
    $q->fields = NULL;
    $q->sql = '
                INSERT INTO productos (categoria, nombre, descripcion, precio)
                VALUES (?, ?, ?, ?)        
              '
    ;

    $categoria = $count;
    $nombre = 'Nom_' . $count;
    $descripcion = 'Descr_' . $count;
    $precio = $count
            . '.'
            . $count
    ;
    $q->data = array("isbd"
        , "{$categoria}"
        , "{$nombre}"
        , "{$descripcion}"
        , "{$precio}"
    );
    $q->exe();
}
// ---------------------------------------------------------
EtiquetasHtml::debug();

EtiquetasHtml::h(1, 'Ejemplo de query');
$tablas = mostrar_tablas();
EtiquetasHtml::printr($tablas);

$name = $tablas[0]['name'];
EtiquetasHtml::h(1, 'Ejemplo de INSERT ' . $name);
$cantidad1 = count_table($name);
EtiquetasHtml::h(2, 'Cantidad actual: ' . $cantidad1);

EtiquetasHtml::h(3, 'Insertando Nuevo: ');
$cantidad1 +=1;
insert_productos($cantidad1);

$cantidad2 = count_table($name);
EtiquetasHtml::h(2, 'Cantidad actual: ' . $cantidad2);
?>
