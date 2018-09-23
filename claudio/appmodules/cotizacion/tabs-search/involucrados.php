<?php
$group= 'co_search_involucrado';
?>
<hr>
<div class="row">
  <div class="small-3 columns">
    <label class="right" for="<?php prefix('coordinador_id') ?>">Coordinador:</label>
  </div>
  <div class="small-9 columns">
    <select id="<?php prefix('coordinador_id') ?>" class="chosen-select-deselect">
      <option value=""></option>
    </select>
  </div>
</div>
<div class="row">
  <div class="small-4 columns">
    <div class="row">
      <div class="small-6 columns">
	<div class="row">
	  <div class="small-2 columns">
	    <input id="<?php prefix('rol_cliente') ?>" class="<?php prefix('rol') ?>" type="checkbox"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="<?php prefix('rol_cliente') ?>">Cliente</label>
	  </div>
	</div>
	<div class="row">
	  <div class="small-2 columns">
	    <input id="<?php prefix('rol_solicitante') ?>" class="<?php prefix('rol') ?>" type="checkbox"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="<?php prefix('rol_solicitante') ?>">Solicitante</label>
	  </div>
	</div>
	<div class="row">
	  <div class="small-2 columns">
	    <input id="<?php prefix('rol_propietario') ?>" class="<?php prefix('rol') ?>" type="checkbox"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="<?php prefix('rol_propietario') ?>">Propietario</label>
	  </div>
	</div>
      </div>
      <div class="small-6 columns">
	<div class="row">
	  <div class="small-2 columns">
	    <input id="<?php prefix('tipo_juridico_radio') ?>" value="juridico" class="<?php prefix('tipo_radio') ?>" name="<?php prefix('tipo_radio') ?>" type="radio"  checked>
	  </div>
	  <div class="small-10 columns">
	    <label for="<?php prefix('tipo_juridico_radio') ?>">Juridico</label>
	  </div>	  
	</div>
	<div class="row">
	  <div class="small-2 columns">
	    <input id="<?php prefix('tipo_natural_radio') ?>" value="natural" class="<?php prefix('tipo_radio') ?>" name="<?php prefix('tipo_radio') ?>" type="radio"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="<?php prefix('tipo_natural_radio') ?>">Natural</label>
	  </div>	  
	</div>
      </div>
    </div>
  </div>
  <div class="small-8 columns" id="<?php prefix('tipo_juridico') ?>">
    <div class="row">
      <div class="small-2 columns">
	<label class="right" for="<?php prefix('tipo_juridico_id') ?>">Razon Social:</label>
      </div>
      <div class="small-10 columns">
	<select id="<?php prefix('tipo_juridico_id') ?>"  class="chosen-select-deselect">
	  <option value=""></option>
	</select>
      </div>
    </div>
    <div class="row" style="display:none">
      <div class="small-2 columns">
	<label class="right" for="<?php prefix('tipo_juridico_contacto_id') ?>">Contacto:</label>
      </div>
      <div class="small-10 columns">
	<select id="<?php prefix('tipo_juridico_contacto_id') ?>"  class="chosen-select-deselect">
	  <option value=""></option>
	</select>
      </div>
    </div>
    <div class="row">
      <div class="small-9 large-push-3 columns" id="<?php prefix('tipo_juridico_contacto_datos') ?>" style="height: 60px">
      </div>
    </div>
  </div>
  
  <div class="small-8 columns" id="<?php prefix('tipo_natural') ?>" style="display:none">
    <div class="row">
      <div class="small-2 columns">
	<label class="right" for="<?php prefix('tipo_natural_id') ?>">Nombre:</label>
      </div>
      <div class="small-10 columns">
	<select id="<?php prefix('tipo_natural_id') ?>"  class="chosen-select-deselect">
	  <option value=""></option>
	</select>
      </div>
    </div>
    <div class="row">
      <div class="small-9 large-push-3 columns" id="<?php prefix('tipo_natural_datos') ?>">
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="small-3 columns">
    <label class="right" for="<?php prefix('vendedor_id') ?>">Vendedor:</label>
  </div>
  <div class="small-9 columns">
    <select id="<?php prefix('vendedor_id') ?>" class="chosen-select-deselect">
      <option value=""></option>
    </select>
  </div>
</div>

<hr>
