<?php
$group= 'co_search_general';
?>
<div class="row">
  <div class="small-3 columns">
    <label class="right">Actualización:</label>
  </div>
  <div class="small-2 columns">
    <input id="<?php prefix('actualizacion_si') ?>" type="checkbox" checked>
    <label for="<?php prefix('actualizacion_si') ?>">Si</label>
  </div>

  <div class="small-2 columns">
    <input id="<?php prefix('actualizacion_no') ?>" type="checkbox" checked>
    <label for="<?php prefix('actualizacion_no') ?>">No</label>
  </div>

  <div class="small-5 columns">
  </div>
</div>

<div class="row">
  <div class="small-3 columns">
    <label for="<?php prefix('tipo_servicio') ?>" class="right">Tipo de Servicio:</label>
  </div>
  <div class="small-9 columns">
    <select id="<?php prefix('tipo_servicio') ?>" class="chosen-select-deselect">
      <option value=""></option>
    </select>
  </div>
</div>

<div class="row">
  <div class="small-3 columns">
    <label for="<?php prefix('estado_cotizacion') ?>" class="right">Estado de Cotización:</label>
  </div>
  <div class="small-9 columns">
    <select id="<?php prefix('estado_cotizacion') ?>" class="chosen-select-deselect">
      <option value=""></option>
    </select>
  </div>
</div>
