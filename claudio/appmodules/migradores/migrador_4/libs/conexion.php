<?php
class Query {

    public $fields = NULL;
    public $sql;
    public $data = NULL;
    public function exe() {
        DBConnector::set_db('claudio');
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