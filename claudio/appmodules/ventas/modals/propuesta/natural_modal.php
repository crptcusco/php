<?php $group_old = $group; ?>
<div id="<?php prefix('persona_natural_modal') ?>" class="reveal-modal select-align-cld" data-reveal>
  <?php $group = 've_propuesta_natural_modal' ?>  
  <h2>Natural</h2>
  <div class="row collapse">
    <div class="small-2 columns">
      <input id="<?php prefix('id') ?>"  value="0" type="hidden">
      <label class="right inline no-margin" for="<?php prefix('nombre') ?>">NOMBRE: </label>
    </div>
    <div class="small-10 columns">
      <input id="<?php prefix('nombre') ?>" class="no-margin"  value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php prefix('documento_tipo') ?>">DOCUMENTO:</label>
    </div>
    <div class="small-4 columns select-align-cld">
      <select class="chosen-select" id="<?php prefix('documento_tipo') ?>">
      </select>
    </div>
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php prefix('documento_numero') ?>">NÚMERO:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('documento_numero') ?>" class="no-margin" value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php prefix('direccion') ?>">DIRECCIÓN:</label>
    </div>
    <div class="small-10 columns">
      <input id="<?php prefix('direccion') ?>" class="no-margin" value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php prefix('telefono') ?>">TELÉFONO:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('telefono') ?>" class="no-margin" value="" type="text" style="">
    </div>
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php prefix('correo') ?>">CORREO:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('correo') ?>" class="no-margin" value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label for="<?php prefix('importante') ?>" class="right inline no-margin">IMPORTANTE:</label>
    </div>
    <div class="small-2 columns">
      <select id="<?php prefix('importante') ?>" class="chosen-select">
	<option value="1"></option>
      </select>
    </div>
    <div class="small-2 columns">
      <label for="<?php prefix('referido') ?>" class="right inline no-margin">INTERMEDIARIO:</label>
    </div>
    <div class="small-6 columns">
      <select id="<?php prefix('referido') ?>" class="chosen-select-deselect">
	<option value=""></option>
      </select>
    </div>
  </div>
  
  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php prefix('persona_estado') ?>">ESTADO: </label>
    </div>
    <div class="small-4 columns">
      <select id="<?php prefix('persona_estado') ?>" class="chosen-select">
	<option value="1"></option>
      </select>
    </div>    
    <div class="small-2 columns <?php prefix('user') ?>">
      <label class="right inline no-margin" for="<?php prefix('vendedor') ?>">VENDEDOR: </label>
    </div>
    <div class="small-4 columns <?php prefix('user') ?>">
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
      <label for="<?php prefix('activo') ?>" class="right no-margin">ACTIVO:</label>
    </div>
    <div class="small-1 columns">
      <input id="<?php prefix('activo') ?>" class="no-margin" type="checkbox" checked>
    </div>
    <div class="small-9 columns">
      <button id="<?php prefix('save') ?>" class="right button tiny no-margin">AÑADIR</button>
      <button id="<?php prefix('cancel') ?>" class="right secondary button tiny no-margin">CANCELAR</button>
    </div>
  </div>
  <div class="row collapse">
    <div class="small-12 columns" id="tabla_involucrado_natural">
    </div>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<?php $group = $group_old; ?>
