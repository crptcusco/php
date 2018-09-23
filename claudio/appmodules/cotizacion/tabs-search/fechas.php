<div class="row">
  <div class="small-3 columns">
    <label class="right inline" for="co_fecha_solicitud">De Solicitud:</label>
  </div>
  <div class="small-3 columns">
     <input type="text" name="co_fecha_solicitud" id="co_fecha_solicitud" value="<?php timestamp_to_str( $input['fecha_solicitud'] ) ?>" class="datapicker-simple" readonly/>
  </div>
  <div class="small-3 small-pull-3 columns">
     <button class="button tiny expand secondary" id="co_fecha_solicitud_clear">Limpiar</button>
  </div>
</div>

<div class="row">
  <div class="small-3 columns">
    <label class="right inline" for="co_fecha_envio_cliente">De Envio al Cliente:</label>
  </div>
  <div class="small-3 columns">
     <input type="text" name="co_fecha_envio_cliente" id="co_fecha_envio_cliente" value="<?php timestamp_to_str( $input['fecha_envio_cliente'] ) ?>" class="datapicker-simple" readonly/>
  </div>
  <div class="small-3 small-pull-3 columns">
     <button class="button tiny expand secondary" id="co_fecha_envio_cliente_clear">Limpiar</button>
  </div>
</div>

<div class="row">
  <div class="small-3 columns">
    <label class="right inline" for="co_fecha_finalizado">De Finalizacion:</label>
  </div>
  <div class="small-3 columns">
     <input type="text" name="co_fecha_finalizado" id="co_fecha_finalizado" value="<?php timestamp_to_str( $input['fecha_finalizacion'] ) ?>" class="datapicker-simple" readonly/>
  </div>
  <div class="small-3 small-pull-3 columns">
     <button class="button tiny expand secondary" id="co_fecha_finalizado_clear">Limpiar</button>
  </div>
</div>

