<div class="row">
  <div class="small-3 columns">
    <label class="right inline" for="co_mensaje_texto">Mensaje:</label>
  </div>
  <div class="small-9 columns">
     <input type="text" id="co_mensaje_texto" value="" />
  </div>
</div>
<div class="row">
  <div class="small-3 columns">
    <label class="right inline" for="co_mensaje_fecha">Proxima Acción:</label>
  </div>
  <div class="small-3 columns">
    <input type="text" id="co_mensaje_fecha" class="datapicker-simple" readonly/>
  </div>
  <div class="small-3 columns" id="co_mensaje_clear_content">
    <button class="button tiny expand secondary" id="co_mensaje_clear">Cancelar</button>
  </div>
  <div class="small-3 columns" id="co_mensaje_save_content">
    <button class="button tiny expand info" id="co_mensaje_save">Publicar Mensaje</button>
  </div>
</div>
<?php

?>
<div class="row">
  <div class="small-12 columns">
    <div id="co_mensajes_tabla"></div>
  </div>
</div>
