<div id="<?php prefix('informe_documentacion_modal') ?>" 
     class="reveal-modal" data-reveal>
  <h2>Documentación</h2>
  <input id="<?php prefix('informe_documentacion_modal_id') ?>" 
         type="hidden" value="0">
  <div class="row collapse">
    <div class="small-3 columns text-right">
      <label for="<?php prefix('informe_documentacion_modal_ruta') ?>" 
             class="inline">
        Ruta:
      </label>
    </div>
    <div class="small-9 columns">
      <input id="<?php prefix('informe_documentacion_modal_ruta') ?>" 
             class="" type="text"> 
    </div>
  </div>
  <div class="row collapse">
    <div class="small-3 columns text-right">
      <label for="<?php prefix('informe_documentacion_modal_descripcion') ?>" 
             class="inline">Descripción:
      </label>
    </div>
    <div class="small-9 columns">
      <textarea
          id="<?php prefix('informe_documentacion_modal_descripcion') ?>"
      ></textarea>
    </div>
  </div>
  <div class="row collapse">
    <div class="small-12 columns text-right">
      <a id="<?php prefix('informe_documentacion_modal_save') ?>"
         class="button tiny close-reveal-modal" 
         style="margin: 0px; position: static; font-size: 0.8em; color: white;">
        Guardar
      </a>
    </div>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
