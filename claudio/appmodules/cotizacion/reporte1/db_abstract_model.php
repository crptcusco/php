<?php

abstract class DBAbstractModel {

    protected $db_host;
    protected $db_user;
    protected $db_pass;
    protected $db_name;
    protected $query;
    protected $rows = array();
    private $conn;
    public $mensaje = 'Hecho';

# métodos abstractos para ABM de clases que hereden

    abstract protected function get();
    
    abstract protected function set();

    abstract protected function edit();

    abstract protected function delete();
# los siguientes métodos pueden definirse con exactitud y
# no son abstractos
# Conectar a la base de datos

    private function open_connection() {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }

# Desconectar la base de datos

    private function close_connection() {
        $this->conn->close();
    }

# Ejecutar un query simple del tipo INSERT, DELETE, UPDATE

    protected function execute_single_query() {
        if ($_POST) {
            $this->open_connection();
            $this->conn->query($this->query);
            $this->close_connection();
        } else {
            $this->mensaje = 'Metodo no permitido';
        }
    }

# Traer resultados de una consulta en un Array

    protected function get_results_from_query() {
        $this->open_connection();
        $result = $this->conn->query($this->query);
//        print_r($this->query);
//        print_r($result);
//        die();
        while ($this->rows[] = $result->fetch_assoc());
        $result->close();
        $this->close_connection();
        array_pop($this->rows);
    }

}

?>