<?php $group_old = $group; ?>
<div id="<?php prefix('visita_modal') ?>" class="reveal-modal" data-reveal>
  <?php $group = 've_propuesta_visita_modal' ?>
  <h2>Seguimiento</h2>
  <div id="<?php prefix('my_form') ?>">
    <input type="hidden" id="<?php prefix('id') ?>" value="0">
    <div class="row collapse">
      <div class="small-3 columns text-right">
	<label for="<?php prefix('estado_id') ?>" class="inline no-margin">ESTADO:</label>
      </div>
      <div class="small-3 columns select-align-cld">
	<select class="chosen-select" id="<?php prefix('estado_id') ?>">
	  <option value="1"></option>
	</select>
      </div>
      <div class="small-1 columns"></div>
    </div>

    <div class="row collapse">
      <div class="small-3 columns text-right">
	<label for="<?php prefix('contacto_id') ?>" class="inline no-margin">CONTACTO:</label>
      </div>
      <div class="small-9 columns select-align-cld">
	<select class="chosen-select-deselect" id="<?php prefix('contacto_id') ?>">
	  <option value="0"></option>
	</select>
      </div>
    </div>

    <div class="row collapse">
      <div class="small-3 columns text-right">
	<label class="inline no-margin" for="<?php prefix('fecha') ?>">FECHA:</label>
      </div>
      <div class="small-3 columns">
	<input type="text" id="<?php prefix('fecha') ?>" class="datapicker-simple no-margin" value="" readonly>
      </div>
      <div class="small-1 columns">&nbsp;</div>
      <div class="small-1 columns text-right">
	<label class="inline no-margin" for="<?php prefix('hora') ?>">HORA:</label>
      </div>
      <div class="small-1 columns">
	<input type="text" id="<?php prefix('hora') ?>" class="no-margin">
      </div>
      <div class="small-1 columns text-right">
	<label class="inline no-margin" for="<?php prefix('minuto') ?>">MINUTO:</label>
      </div>
      <div class="small-1 columns">
	<input type="text" id="<?php prefix('minuto') ?>" class="no-margin ">
      </div>
      <div class="small-1 columns select-align-cld">
	<select id="<?php prefix('meridiano') ?>" class="chosen-select">
	  <option value="am">AM</option>
	  <option value="pm">PM</option>
	</select>
      </div>
    </div>  

    <div class="row collapse">
      <div class="small-3 columns text-right">
	<label class="inline no-margin" for="">UBIGEO:</label>
      </div>
      <div class="small-3 columns select-align-cld">
	<select class="chosen-select-deselect" id="<?php prefix('departamento_id') ?>">
	  <option value="15"></option>
	</select>
      </div>
      <div class="small-3 columns select-align-cld">
	<select class="chosen-select-deselect" id="<?php prefix('provincia_id') ?>">
	  <option value="1"></option>
	</select>
      </div>
      <div class="small-3 columns select-align-cld">
	<select class="chosen-select-deselect" id="<?php prefix('distrito_id') ?>">
	  <option value="1"></option>
	</select>
      </div>        
    </div>

    <div class="row collapse">
      <div class="small-3 columns text-right">
	<label class="inline no-margin" for="<?php prefix('direccion') ?>">DIRECCIÓN:</label>
      </div>
      <div class="small-9 columns">
	<input type="text" id="<?php prefix('direccion') ?>" class="no-margin">
      </div>
    </div>  

    <div class="row collapse">
      <div class="small-3 columns text-right">
	<label class="inline no-margin" for="<?php prefix('observacion') ?>">OBSERVACIÓN:</label>
      </div>
      <div class="small-9 columns">
	<input type="text" id="<?php prefix('observacion') ?>" class="no-margin">
      </div>
    </div>

    <div class="row collapse">
      <div class="small-12 columns text-right">
	<button class="button tiny no-margin" id="<?php prefix('save') ?>" >GUARDAR</button>
      </div>
    </div>
  </div><!-- end myform -->
  <div id="<?php prefix('my_mensaje') ?>" ></div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<?php $group = $group_old; ?>
