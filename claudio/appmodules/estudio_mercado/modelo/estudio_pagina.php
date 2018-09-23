<?php

require_once(RUTA.'sql/db_abstract_model.php');

class Pagina extends DBAbstractModel {

    public $nombre;
    public $url;
    public $categoria;
    protected $id;

    function __construct() {
        $this->db_name = 'cotiza_factura';
    }

    public function get($id = '') {
        if ($id != ''):
            $this->query = "
        SELECT nombre,url,categoria_id 
        FROM in_pagina
        WHERE id = '$id'
        ";
        $this->get_results_from_query();
        endif;
        if (count($this->rows) == 1):
            foreach ($this->rows[0] as $propiedad => $valor):
                $this->$propiedad = $valor;
            endforeach;
            endif;
        }

        public function set($pagina_data = array()) {
            if (array_key_exists('id', $pagina_data)):
                $this->get($pagina_data['id']);
            foreach ($pagina_data as $campo => $valor):
                $$campo = $valor;
            endforeach;
            $this->query = "
            INSERT INTO in_pagina
            (nombre, url, categoria_id)
            VALUES
            ('$nombre', '$url', '$categoria')
            ";

            //echo $this->query;
            //die();
            $this->execute_single_query();
            endif;
        }

        public function edit($pagina_data = array()) {
            foreach ($pagina_data as $campo => $valor):
                $$campo = $valor;
            endforeach;
            $this->query = "
            UPDATE in_pagina
            SET nombre='$nombre',
            url='$url',
            WHERE id = '$id'
            ";
            $this->execute_single_query();
        }

        public function delete($pagina_id = '') {
            $this->query = "
            DELETE FROM in_pagina
            WHERE pagina = '$pagina_id'
            ";
            $this->execute_single_query();
        }

        public function listar_pagina_categoria($id) {
            $this->query = 'select id,nombre,url from in_pagina where categoria_id='.$id.';';
            $this->rows = null;
            $this->get_results_from_query();
            return $this->rows;
        }
        
        public function listar_categorias() {
            $this->query = 'select id,nombre from in_categoria';
            $this->rows = null;
            $this->get_results_from_query();
            return $this->rows;
        }

        public function existe_pagina_categoria($in) {
            $this->query = "SELECT * FROM in_categoria
            WHERE nombre = '{$in['nombre']}' LIMIT 1;
            ";
            $this->rows = null;
            $this->get_results_from_query();
            return $this->rows;
        }

        public function guardar_pagina_categoria($in) {
            $this->query = "INSERT INTO in_categoria SET nombre = '{$in['nombre']}';";
            $this->execute_single_query();
        }


        function __destruct() {
            unset($this);
        }

    }

    ?>