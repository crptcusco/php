<?php
$group = 'modal_co_involucrado_juridico_contacto'
?>

<div id="modal_co_involucrado_juridico_contacto" class="reveal-modal" data-reveal>
  <h2>Contactos</h2>
  <input id="<?php prefix('id') ?>"  value="0" type="hidden">
  <input id="<?php prefix('juridica_id') ?>"  value="0" type="hidden">

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline" for="<?php prefix('nombre') ?>">Nombre: </label>
    </div>
    <div class="small-10 columns">
      <input id="<?php prefix('nombre') ?>"  value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline" for="<?php prefix('cargo') ?>">Cargo:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('cargo') ?>"  value="" type="text" style="">
    </div>
    <div class="small-2 columns">
      <label class="right inline" for="<?php prefix('telefono') ?>">Teléfono:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('telefono') ?>"  value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline" for="<?php prefix('correo') ?>">Correo:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('correo') ?>"  value="" type="text" style="">
    </div>
    <div class="small-6 columns">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label for="<?php prefix('status') ?>" class="right">Activo:</label>
    </div>
    <div class="small-1 columns">
      <input id="<?php prefix('status') ?>" class="" type="checkbox" checked>
    </div>
    <div class="small-9 columns">
      <button id="<?php prefix('save') ?>" class="right button tiny">Añadir</button>
      <button id="<?php prefix('cancel') ?>" class="right secondary  button tiny">Cancelar</button>
    </div>
  </div>

  <div class="row collapse">
    <div class="small-12 columns" id="<?php prefix('tabla') ?>">
    </div>
  </div>

  <a class="close-reveal-modal">&#215;</a>
</div>
