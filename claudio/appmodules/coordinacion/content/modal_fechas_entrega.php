<div id="<?php prefix('informe_fechas_modal') ?>" class="reveal-modal" data-reveal>
  <h2>Fechas de Entrega</h2>
  <input id="<?php prefix('informe_fechas_modal_id') ?>" 
         type="hidden" value="0"> 
  <div class="row collapse">
    <div class="small-3 columns text-right">
      <label for="<?php prefix('informe_fechas_modal_fecha') ?>" 
             class="inline">
        Fecha
      </label>
    </div>
    <div class="small-3 columns">
      <input id="<?php prefix('informe_fechas_modal_fecha') ?>" 
             class="datapicker-simple text-center" type="text" readonly> 
    </div>
    <div class="small-3 columns">
      <label class="inline" style="margin:0">
        <a class="datapicker-simple-clear"
           data-picker="<?php prefix('informe_fechas_modal_fecha') ?>">
          Limpiar
        </a>        
      </label>      
    </div>
    <div class="small-3 columns">
    </div>
  </div>
  <div class="row collapse">
    <div class="small-3 columns text-right">
      <label for="<?php prefix('informe_fechas_modal_tipo_informe_id') ?>" 
             class="">
        Tipo de Informes
      </label>
    </div>
    <div class="small-9 columns">
      <select id="<?php prefix('informe_fechas_modal_tipo_informe_id') ?>" 
              class="chosen-select">
        <option value="1"></option>
      </select>
    </div>
  </div>
  <div class="row collapse">
    <div class="small-12 columns text-right">
      <a id="<?php prefix('informe_fechas_modal_save') ?>"
         class="button tiny close-reveal-modal" 
         style="margin: 0px; position: static; font-size: 0.8em; color: white;">
        Guardar
      </a>
    </div>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
