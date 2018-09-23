<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class pagina {

    public $nombre;
    public $url;
    public $categoria;

    # constructor de la clase

    function __construct() {
        $this->setNombre('en uso');
    }

    function getNombre() {
        return $this->nombre;
    }

    function getUrl() {
        return $this->url;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

}

class Cliente {

    static public $nombre_completo = 'Cliente desconocido';
    protected $id = 1001;

    function __construct() {
        self::$nombre = 'Juan Pérez';
    }

}

print Cliente::$nombre_completo;

