<?php
$group = 'co_montos_field_perito_modal'
?>

<div id="<?php echo $group ?>" class="reveal-modal" data-reveal>
  <h2>Peritos</h2>

  <input id="<?php prefix('id') ?>"  value="0" type="hidden">

  <div class="row collapse">
    <div class="small-1 columns">
      <label class="right inline" for="<?php prefix('nombre') ?>">Nombre: </label>
    </div>
    <div class="small-11 columns">
      <input id="<?php prefix('nombre') ?>"  value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-1 columns">
      <label class="right inline" for="<?php prefix('telefono') ?>">Telefono: </label>
    </div>
    <div class="small-5 columns">
      <input id="<?php prefix('telefono') ?>"  value="" type="text" style="">
    </div>
    <div class="small-1 columns">
      <label class="right inline" for="<?php prefix('correo') ?>">Correo: </label>
    </div>
    <div class="small-5 columns">
      <input id="<?php prefix('correo') ?>"  value="" type="text" style="">
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
