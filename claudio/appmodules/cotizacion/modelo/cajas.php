<?php 
session_start ();
class Query {

    public $fields = NULL;
    public $sql;
    public $data = NULL;

    public function exe() {
        DBConnector::set_db('cotiza_factura');
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
function clear_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}