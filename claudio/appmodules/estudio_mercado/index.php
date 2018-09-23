<?php
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include ("../../librerias.v2/mysql/dbconnector.php");
include ("./models/combos.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$title = 'Sistema de Tasaciones y Estudios de Mercado';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
?>
<style>
 h1{
     font-family: Verdana,Arial,sans-serif;
     color: #244c89;
 }
</style>

<div class="row">
  <div class="large-12 columns">
    <div class="medium-3 columns">
      <img src="../../static/img/LOGO.JPG"></td>
    </div>
    <div class="medium-9 columns">
      <h1 class="">Sistema de Tasaciones y Estudios de Mercado</h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="large-9 columns">
    <div class="row" id="consulta">
      <form action="inmuebles.php" method="POST">
        <div class="medium-4 columns">     
          <fieldset id="categorias">
            <legend>Categorias</legend>
            <!--                    <a id="categoria_inmuebles"><u>Inmuebles</u></a><br>-->
            <input type="checkbox" class="categoria" name="categoria[]" tip='1' value="casa" id="categoria_casa" checked><label for="categoria_casa">Casa</label><br>
            <input type="checkbox" class="categoria" name="categoria[]" tip='1' value="departamento" id="categoria_departamento" checked><label for="categoria_departamento">Departamento</label><br>
            <input type="checkbox" class="categoria" name="categoria[]" tip='1' value="local_comercial" id="categoria_local_comercial" checked><label for="categoria_local_comercial">Local Comercial</label><br>
            <input type="checkbox" class="categoria" name="categoria[]" tip='1' value="local_industrial" id="categoria_local_industrial" checked><label for="categoria_local_industrial">Local Industrial</label><br>
            <input type="checkbox" class="categoria" name="categoria[]" tip='1' value="terreno" id="categoria_terreno" checked><label for="categoria_terreno">Terreno</label><br>
	    <input type="checkbox" class="categoria" name="categoria[]" tip='1' value="oficina" id="categoria_oficina" checked><label for="categoria_oficina">Oficina</label><br>
            <input type="checkbox" class="categoria" name="categoria[]" tip='2' value="maquinaria" id="categoria_maquinaria"><label for="categoria_maquinaria" >Maquinaria</label><br>
            <input type="checkbox" class="categoria" name="categoria[]" tip='2' value="vehiculo" id="categoria_vehiculo"><label for="categoria_vehiculo" >Vehiculo</label><br>
          </fieldset>
        </div>
        <div class="medium-8 columns">
          <div id='inmueble'>
            <fieldset>
              <legend>Inmuebles</legend>
              <div class="row">
                <div class="small-12 columns" id="inm_departamento_conteiner">
                  <select id="inm_departamento" name="inm_departamento" data-placeholder="Departamento" class="chosen-select" >
                    <?php $departamento = get_options_departamentos(14) ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-11 small-push-1 columns" id ="inm_provincia_conteiner">
                  <select id="inm_provincia" name="inm_provincia" data-placeholder="Provincia" class="chosen-select" >
                    <option value=""></option>
                    <option value="127" selected>Ajax</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-10 small-push-2 columns" id="inm_distrito_conteiner">
                  <select id="inm_distrito" name="inm_distrito" data-placeholder="Distrito" class="chosen-select" >
                    <option value=""></option>
                    <option value="23" selected>Ajax</option>
                  </select>
                </div>
              </div>
            </fieldset>
          </div>
          <div id='no-inmueble'>
            <fieldset>
              <legend>Maquinarias / Vehiculos</legend>
              <div class="row">
                <div class="small-12 columns" id="nin_tipo_maquinaria_conteiner">
                  <select id="nin_tipo_maquinaria" name="nin_tipo_maquinaria" data-placeholder="Tipo (Maquinaria)" class="chosen-select" >
                    <?php get_options_tipo_maquinaria() ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-11 small-push-1 columns" id ="nin_marca_maquinaria_conteiner">                                                   
                  <select id="nin_marca_maquinaria" name="nin_marca_maquinaria" data-placeholder="Marca (Maquinaria)" class="chosen-select" >
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-10 small-push-2 columns" id ="nin_modelo_maquinaria_conteiner">
                  <select id="nin_modelo_maquinaria" name="nin_modelo_maquinaria" data-placeholder="Modelo (Maquinaria)" class="chosen-select" >
                    <option value=""></option>
                  </select>
                </div>
              </div>	     
              <div class="row">
                <div class="small-12 columns" id="nin_tipo_vehiculo_conteiner">
                  <select id="nin_tipo_vehiculo" name="nin_tipo_vehiculo" data-placeholder="Tipo (Vehiculo)" class="chosen-select" >
                    <?php get_options_tipo_vehiculo() ?>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="small-11 small-push-1 columns" id="nin_marca_vehiculo_conteiner">
                  <select id="nin_marca_vehiculo" name="nin_marca_vehiculo" data-placeholder="Marca (Vehiculo)" class="chosen-select" >
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-10 small-push-2 columns" id="nin_modelo_vehiculo_conteiner">
                  <select id="nin_modelo_vehiculo" name="nin_modelo_vehiculo" data-placeholder="Modelo (Vehiculo)" class="chosen-select" >
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-12 columns" id="nin_anio_conteiner">
                  <select id="nin_anio" name="nin_anio" data-placeholder="A&ntilde;o de fabricación" class="chosen-select" >
                    <?php get_options_anio() ?>
                  </select>
                </div>
              </div>
            </fieldset>
          </div>
          <input type="submit" class="button expand" value="Buscar" id="buscar">

        </div>
      </form>
    </div>
  </div>
  <div class="large-3 columns">
    <fieldset id="ingreso">
      <legend>Registro de Datos</legend>
      <!--                    <a id="categoria_inmuebles"><u>Inmuebles</u></a><br>-->
      <a href="vista/tasacion_informe.php" class="button  primary expand">Informes de Tasacion</a>
      <a href="vista/estudio_externo.php" class="button success expand">Estudios de Inmuebles</a>
      <a href="vista/estudio_vehiculo.php" class="button success expand">Estudios de Vehiculos</a>
      <a href="vista/estudio_maquinaria.php" class="button warning expand">Estudios de Maquinarias</a>
      <a href="vista/reporte_registros.php" class="button alert expand">Reporte de Registros</a>
      <a href="vista/estudio_pagina.php" class="button primary expand">Paginas de Consulta</a>
      <a href="../generador_rutas/" class="button secondary expand">Generador de Rutas</a>

    </fieldset>
  </div>
</div>  

<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_pantalla01.js?v=1.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_combos.js?v=09';

EtiquetasHtml::footer();
