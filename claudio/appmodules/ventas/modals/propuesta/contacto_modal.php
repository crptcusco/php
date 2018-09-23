<?php $group_old = $group; ?>
<div id="<?php prefix('persona_contacto_modal') ?>" class="reveal-modal" data-reveal>
  <?php $group = 've_propuesta_contacto_modal' ?>  
  <h2>Contacto</h2>
  <div class="mierdde" id="<?php prefix('my_form') ?>">
    <input id="<?php prefix('id') ?>"  value="0" type="hidden">
    <input id="<?php prefix('tipo') ?>"  value="0" type="hidden">
    <input id="<?php prefix('parent_id') ?>"  value="0" type="hidden">

    <div class="row collapse">
      <div class="small-2 columns">
	<label class="right inline no-margin" for="<?php prefix('nombre') ?>">NOMBRE: </label>
      </div>
      <div class="small-10 columns">
	<input id="<?php prefix('nombre') ?>" class="no-margin" value="" type="text" style="">
      </div>
    </div>
    
    <div class="row collapse">
      <div class="small-2 columns">
	<label class="right inline no-margin" for="<?php prefix('cargo') ?>">CARGO: </label>
      </div>
      <div class="small-4 columns">
	<input id="<?php prefix('cargo') ?>" class="no-margin" value="" type="text" style="">
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
	<label class="right inline no-margin" for="<?php prefix('correo') ?>">CORREO: </label>
      </div>
      <div class="small-4 columns">
	<input id="<?php prefix('correo') ?>" class="no-margin" value="" type="text" style="">
      </div>
      <div class="small-6 columns">
      </div>
    </div>

    <div class="row collapse">
      <div class="small-2 columns">
	<label for="<?php prefix('status') ?>" class="right no-margin">Activo:</label>
      </div>
      <div class="small-1 columns">
	<input id="<?php prefix('status') ?>" class="no-margin" type="checkbox" checked>
      </div>
      <div class="small-9 columns">
	<button id="<?php prefix('save') ?>" class="right button tiny no-margin">AÑADIR</button>
	<button id="<?php prefix('cancel') ?>" class="right secondary  button tiny no-margin">CANCELAR</button>
      </div>
    </div>

    <div class="row collapse">
      <div class="small-12 columns" id="<?php prefix('tabla') ?>">
      </div>
    </div>
  </div>
  <div id="<?php prefix('my_mensage') ?>"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<?php $group = $group_old; ?>
