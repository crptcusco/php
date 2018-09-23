<div id="modal_co_involucrado_juridico" class="reveal-modal" data-reveal>
  <a class="close-reveal-modal">&#215;</a>
  <div class="row collapse">
    <div class="small-2 columns">
      <style>
       
      </style>
      <ul class="tabs vertical claudio" data-tab>
	<li class="tab-title"><a id="<?php get_prefix_juridico('tabs-link-1') ?>" href="#<?php get_prefix_juridico('tabs-link-modal-1') ?>">Clasificación</a></li>
	<li class="tab-title"><a id="<?php get_prefix_juridico('tabs-link-3') ?>" href="#<?php get_prefix_juridico('tabs-link-modal-3') ?>">Actividad</a></li>
	<li class="tab-title"><a id="<?php get_prefix_juridico('tabs-link-2') ?>" href="#<?php get_prefix_juridico('tabs-link-modal-2') ?>">Grupo</a></li>
	<li class="tab-title active"><a id="<?php get_prefix_juridico('tabs-link-4') ?>" href="#<?php get_prefix_juridico('tabs-link-modal-4') ?>">Juridico</a></li>
      </ul>
    </div>
    <div class="small-10 columns">
      <div class="tabs-content no-margin">
	<div class="content " id="<?php get_prefix_juridico('tabs-link-modal-1') ?>">
	  <input id="<?php get_prefix_juridico('clasificacion_tab_id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline" for="<?php get_prefix_juridico('clasificacion_tab_nombre') ?>">Nombre: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php get_prefix_juridico('clasificacion_tab_nombre') ?>"  value="" type="text">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php get_prefix_juridico('clasificacion_tab_status') ?>" class="right">Activo:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php get_prefix_juridico('clasificacion_tab_status') ?>" class="" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php get_prefix_juridico('clasificacion_tab_save') ?>" class="right button tiny">Añadir</button>
	      <button id="<?php get_prefix_juridico('clasificacion_tab_cancel') ?>" class="right secondary  button tiny">Cancelar</button>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-12 columns" id="<?php get_prefix_juridico('clasificacion_tab_tabla') ?>">
	      [table]
	    </div>
	  </div>
	</div>
	<div class="content" id="<?php get_prefix_juridico('tabs-link-modal-2') ?>">
	  <input id="<?php get_prefix_juridico('grupo_tab_id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline" for="<?php get_prefix_juridico('grupo_tab_nombre') ?>">Nombre: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php get_prefix_juridico('grupo_tab_nombre') ?>"  value="" type="text">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php get_prefix_juridico('grupo_tab_status') ?>" class="right">Activo:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php get_prefix_juridico('grupo_tab_status') ?>" class="" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php get_prefix_juridico('grupo_tab_save') ?>" class="right button tiny">Añadir</button>
	      <button id="<?php get_prefix_juridico('grupo_tab_cancel') ?>" class="right secondary  button tiny">Cancelar</button>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-12 columns" id="<?php get_prefix_juridico('grupo_tab_tabla') ?>">
	      [table]
	    </div>
	  </div>
	</div>
	<div class="content" id="<?php get_prefix_juridico('tabs-link-modal-3') ?>">
	  <input id="<?php get_prefix_juridico('actividad_tab_id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline" for="<?php get_prefix_juridico('actividad_tab_nombre') ?>">Nombre: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php get_prefix_juridico('actividad_tab_nombre') ?>"  value="" type="text">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php get_prefix_juridico('actividad_tab_status') ?>" class="right">Activo:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php get_prefix_juridico('actividad_tab_status') ?>" class="" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php get_prefix_juridico('actividad_tab_save') ?>" class="right button tiny">Añadir</button>
	      <button id="<?php get_prefix_juridico('actividad_tab_cancel') ?>" class="right secondary  button tiny">Cancelar</button>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-12 columns" id="<?php get_prefix_juridico('actividad_tab_tabla') ?>">
	      [Table]
	    </div>
	  </div>
	</div>
	<div class="content active" id="<?php get_prefix_juridico('tabs-link-modal-4') ?>">
	  <input id="<?php get_prefix_juridico('id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('razon') ?>">Razón: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php get_prefix_juridico('razon') ?>" class="no-margin"  value="" type="text" style="">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('ruc') ?>">Ruc: </label>
	    </div>
	    <div class="small-4 columns">
	      <input id="<?php get_prefix_juridico('ruc') ?>"  class="no-margin"  value="" type="text" style="">
	    </div>
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('telefono') ?>">Teléfono: </label>
	    </div>
	    <div class="small-4 columns">
	      <input id="<?php get_prefix_juridico('telefono') ?>" class="no-margin"  value="" type="text" style="">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('direccion') ?>">Dirección: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php get_prefix_juridico('direccion') ?>" class="no-margin" value="" type="text" style="">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('clasificacion') ?>">Clasificación: </label>
	    </div>
	    <div class="small-4 columns">
	      <select id="<?php get_prefix_juridico('clasificacion') ?>" class="chosen-select ">
	      </select>
	    </div>
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('actividad') ?>">Actividad: </label>
	    </div>
	    <div class="small-4 columns">
	      <select id="<?php get_prefix_juridico('actividad') ?>" class="chosen-select-deselect">
	      </select>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php get_prefix_juridico('grupo') ?>">Grupo: </label>
	    </div>
	    <div class="small-4 columns">
	      <select id="<?php get_prefix_juridico('grupo') ?>" class="chosen-select-deselect">
		<option value="0"></option>
	      </select>
	    </div>
	    <div class="small-6 columns">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php get_prefix_juridico('status') ?>" class="right">Activo:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php get_prefix_juridico('status') ?>" class="no-margin" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php get_prefix_juridico('save') ?>" class="right button no-margin tiny">Añadir</button>
	      <button id="<?php get_prefix_juridico('cancel') ?>" class="right secondary  button no-margin tiny">Cancelar</button>
	    </div>
	  </div>
	</div>
      </div>
    </div>

    <div class="row collapse">
      <div class="small-12 columns" >
        <style>
         #modal_co_involucrado_juridico_field_tabla input.active,
         #modal_co_involucrado_juridico_field_tabla select.active
         {
             background-color: #aaffa9;
         }
         #modal_co_involucrado_juridico_field_tabla  input,
         #modal_co_involucrado_juridico_field_tabla  select
         {
             font-size: 0.8em;
         }
         #modal_co_involucrado_juridico_field_tabla  td,
         #modal_co_involucrado_juridico_field_tabla  th
         {
             padding: 0;
             font-size: 0.8em;
         }
        </style>
        <table class="" id="modal_co_involucrado_juridico_field_tabla">
          <thead>
            <tr>
              <?php $i = -1 ?>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
              <td colspan="2">
                <select class="no-margin  search-input-select"
                        data-column="<?php echo ++$i ?>">
                  <option value=""></option>
                  <option value="01">Activado</option>
                  <option value="00">Desactivado</option>
                </select>
              </td>
              <!-- <?php echo ++$i ?> -->

            </tr>
            <tr>
              <th width="90">Razón</th>
              <th>Clasificación</th>
              <th>Actividad</th>
              <th width="90">Grupo</th>
              <th>Ruc</th>
              <th><span style="display: block; width: 150px;">Dirección</span></th>
              <th>Teléfono</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
function get_prefix_juridico($name) {
  echo 'modal_co_involucrado_juridico_field_' . $name;
}
?>

