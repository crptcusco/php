<?php $group_old = $group; ?>
<div id="<?php prefix('persona_juridico_modal') ?>" class="reveal-modal" data-reveal>
  <?php $group = 've_propuesta_juridico_modal' ?>  
  <a class="close-reveal-modal">&#215;</a>
  <div class="row collapse">
    <div class="small-2 columns">
      <ul class="tabs vertical claudio" data-tab>
	<li class="tab-title"><a id="<?php prefix('tabs-link-1') ?>" href="#<?php prefix('tabs-link-modal-1') ?>"  style="padding: 1em 0.4em; text-align: right;">CLASIFICACIÓN</a></li>
	<li class="tab-title"><a id="<?php prefix('tabs-link-3') ?>" href="#<?php prefix('tabs-link-modal-3') ?>"  style="padding: 1em 0.4em; text-align: right;">ACTIVIDAD</a></li>
	<li class="tab-title"><a id="<?php prefix('tabs-link-2') ?>" href="#<?php prefix('tabs-link-modal-2') ?>"  style="padding: 1em 0.4em; text-align: right;">GRUPO</a></li>
	<li class="tab-title active"><a id="<?php prefix('tabs-link-4') ?>" href="#<?php prefix('tabs-link-modal-4') ?>"  style="padding: 1em 0.4em;  text-align: right;">JURÍDICO</a></li>
      </ul>
    </div>
    <div class="small-10 columns">
      <div class="tabs-content">
	<div class="content " id="<?php prefix('tabs-link-modal-1') ?>">
	  <input id="<?php prefix('clasificacion_tab_id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline no-margin" for="<?php prefix('clasificacion_tab_nombre') ?>">NOMBRE: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php prefix('clasificacion_tab_nombre') ?>" class="no-margin" value="" type="text">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php prefix('clasificacion_tab_status') ?>" class="right">ACTIVO:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php prefix('clasificacion_tab_status') ?>" class="" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php prefix('clasificacion_tab_save') ?>" class="right button tiny">AÑADIR</button>
	      <button id="<?php prefix('clasificacion_tab_cancel') ?>" class="right secondary  button tiny">CANCELAR</button>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-12 columns" id="<?php prefix('clasificacion_tab_tabla') ?>">
	      [table]
	    </div>
	  </div>
	</div>
	<div class="content" id="<?php prefix('tabs-link-modal-2') ?>">
	  <input id="<?php prefix('grupo_tab_id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline no-margin" for="<?php prefix('grupo_tab_nombre') ?>">NOMBRE: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php prefix('grupo_tab_nombre') ?>" class="no-margin" value="" type="text">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php prefix('grupo_tab_status') ?>" class="right">ACTIVO:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php prefix('grupo_tab_status') ?>" class="" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php prefix('grupo_tab_save') ?>" class="right button tiny">AÑADIR</button>
	      <button id="<?php prefix('grupo_tab_cancel') ?>" class="right secondary  button tiny">CANCELAR</button>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-12 columns" id="<?php prefix('grupo_tab_tabla') ?>">
	      [table]
	    </div>
	  </div>
	</div>
	<div class="content" id="<?php prefix('tabs-link-modal-3') ?>">
	  <input id="<?php prefix('actividad_tab_id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline no-margin" for="<?php prefix('actividad_tab_nombre') ?>">NOMBRE: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php prefix('actividad_tab_nombre') ?>" class="no-margin" value="" type="text">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php prefix('actividad_tab_status') ?>" class="right">ACTIVO: </label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php prefix('actividad_tab_status') ?>" class="" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php prefix('actividad_tab_save') ?>" class="right button tiny">AÑADIR</button>
	      <button id="<?php prefix('actividad_tab_cancel') ?>" class="right secondary  button tiny">CANCELAR</button>
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-12 columns" id="<?php prefix('actividad_tab_tabla') ?>">
	      [Table]
	    </div>
	  </div>
	</div>
	<div class="content active" id="<?php prefix('tabs-link-modal-4') ?>" >
	  <input id="<?php prefix('id') ?>"  value="0" type="hidden">
	  <div class="row collapse">
	    <div class="small-2 columns">      
	      <label class="right inline no-margin" for="<?php prefix('razon') ?>">RAZÓN: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php prefix('razon') ?>" class="no-margin" value="" type="text" style="">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('ruc') ?>">RUC: </label>
	    </div>
	    <div class="small-4 columns">
	      <input id="<?php prefix('ruc') ?>" class="no-margin" value="" type="text" style="">
	    </div>
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('telefono') ?>">TELÉFONO: </label>
	    </div>
	    <div class="small-4 columns">
	      <input id="<?php prefix('telefono') ?>" class="no-margin" value="" type="text" style="">
	    </div>
	  </div>
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('direccion') ?>">DIRECCIÓN: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php prefix('direccion') ?>" class="no-margin" value="" type="text" style="">
	    </div>
	  </div>
	  
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('clasificacion') ?>">CLASIFICACIÓN: </label>
	    </div>
	    <div class="small-4 columns select-align-cld">
	      <select id="<?php prefix('clasificacion') ?>" class="chosen-select">
	      </select>
	    </div>
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('actividad') ?>">ACTIVIDAD: </label>
	    </div>
	    <div class="small-4 columns select-align-cld">
	      <select id="<?php prefix('actividad') ?>" class="chosen-select-deselect">
	      </select>
	    </div>
	  </div>
	  
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php prefix('importante') ?>" class="right inline no-margin">IMPORTANTE:</label>
	    </div>
	    <div class="small-2 columns select-align-cld">
	      <select id="<?php prefix('importante') ?>" class="chosen-select">
		<option value="1"></option>
	      </select>
	    </div>
	    <div class="small-2 columns">
	      <label for="<?php prefix('referido') ?>" class="right inline no-margin">INTERMEDIARIO:</label>
	    </div>
	    <div class="small-6 columns select-align-cld">
	      <select id="<?php prefix('referido') ?>" class="chosen-select-deselect">
		<option value=""></option>
	      </select>
	    </div>
	  </div>
	  
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('grupo') ?>">GRUPO: </label>
	    </div>
	    <div class="small-4 columns select-align-cld">
	      <select id="<?php prefix('grupo') ?>" class="chosen-select-deselect">
		<option value="0"></option>
	      </select>
	    </div>
 	    <div class="small-6 columns"></div>
	  </div>
	  
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('persona_estado') ?>">ESTADO: </label>
	    </div>
              <div class="small-4 columns select-align-cld" >
                  <select id="<?php prefix('persona_estado') ?>" class="chosen-select" disabled="true">
		<option value="1"></option>
	      </select>
	    </div>	    
	    <div class="small-2 columns <?php prefix('user') ?>">
	      <label class="right inline no-margin" for="<?php prefix('vendedor') ?>">VENDEDOR: </label>
	    </div>
	    <div class="small-4 columns select-align-cld <?php prefix('user') ?>">
	      <select id="<?php prefix('vendedor') ?>" class="chosen-select-deselect">
	    	<option value="0"></option>
	      </select>	      
	    </div>
	  </div>
	  
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label class="right inline no-margin" for="<?php prefix('observacion') ?>">OBSERVACIÓN: </label>
	    </div>
	    <div class="small-10 columns">
	      <input id="<?php prefix('observacion') ?>" class="no-margin" value="" type="text" style="">
	    </div>	    
	  </div>
	  
	  <div class="row collapse">
	    <div class="small-2 columns">
	      <label for="<?php prefix('status') ?>" class="right no-margin">ACTIVO:</label>
	    </div>
	    <div class="small-1 columns">
	      <input id="<?php prefix('status') ?>" class="no-margin" type="checkbox" checked>
	    </div>
	    <div class="small-9 columns">
	      <button id="<?php prefix('save') ?>" class="right button no-margin tiny">AÑADIR</button>
	      <button id="<?php prefix('cancel') ?>" class="right secondary button  no-margin tiny">CANCELAR</button>
	    </div>
	  </div>	 
	</div>
      </div>
    </div>
  </div>
  <div class="row collapse">
    <div class="small-12 columns">
      <style>
       #<?php prefix('tabla') ?> input.active,
       #<?php prefix('tabla') ?> select.active
       {
           background-color: #aaffa9;
       }
       #<?php prefix('tabla') ?> input,
       #<?php prefix('tabla') ?> select
       {
           font-size: 0.8em;
       }
       #<?php prefix('tabla') ?> td,
       #<?php prefix('tabla') ?> th
       {
           padding: 0;
           font-size: 0.8em;
       }
      </style>
      <div class="row collapse">
	<div class="small-12 columns" id="<?php prefix('tabla') ?>">
	  [table]
	</div>
      </div>      
    </div>
  </div>  
</div>
<?php $group = $group_old; ?>
