<a id="link_finalizar_cotizacion" data-reveal-id="modal_finalizar_cotizacion" style="display:none">click</a>
<div id="modal_finalizar_cotizacion" class="reveal-modal" data-reveal>
  <h2>Finalizando Cotización</h2>
  <div class="modal_ajax">
    <form action="save.php" method="POST">
      <input type="hidden" id="co_id_cotizacion_finalizada" name="id" value="">
      <input type="hidden" id="co_codigo_cotizacion_finalizada" name="co_codigo" value="">
      <input type="hidden" id="co_actualizacion_cotizacion_finalizada" name="co_actualizacion" value="">
      <input type="hidden" id="co_tipo_servicio_cotizacion_finalizada" name="co_tipo_servicio" value="">
      <input type="hidden" id="co_estado_cotizacion_cotizacion_finalizada" name="co_estado_cotizacion" value="">
      <input type="hidden" id="co_fecha_solicitud_cotizacion_finalizada" name="co_fecha_solicitud" value="">
      <input type="hidden" id="co_fecha_envio_cliente_cotizacion_finalizada" name="co_fecha_envio_cliente" value="">
      <input type="hidden" id="co_fecha_finalizado_cotizacion_finalizada" name="co_fecha_finalizado" value="">
      <input type="hidden" id="co_involucrados_vendedor_cotizacion_finalizada" name="co_involucrados_vendedor" value="">
      <input type="hidden" id="co_tipo_cotizacion_cotizacion_finalizada" name="co_tipo_cotizacion" value="">
      <input type="hidden" id="co_desglose_cotizacion_finalizada" name="co_desglose" value=""> 
      <!-- montos -->
      <input type="hidden" id="co_montos_field_total_sin_igv_cotizacion_finalizada" name="datos.montos_sin" value="">
      <input type="hidden" id="co_montos_field_total_igv_cotizacion_finalizada" name="montos_igv_si" value="">
      <input type="hidden" id="co_montos_field_igv_oculto_cotizacion_finalizada" name="montos_igv_monto" value="">
      <input type="hidden" id="co_montos_field_total_igv_direccion_cotizacion_finalizada" name="montos_de" value="">
      <input type="hidden" id="co_montos_field_total_con_igv_cotizacion_finalizada" name="montos_con" value="">
      <input type="hidden" id="co_montos_field_total_moneda_cotizacion_finalizada" name="montos_moneda_id" value="">
      <input type="hidden" id="co_montos_field_total_moneda_monto_cotizacion_finalizada" name="montos_cambio" value="">

      <!-- <input type="text" id="_cotizacion_finalizada" name="" value=""> -->
      <div class="row">
	<div class="small-6 small-centered columns text-center">
	  <label for="co_estado_cotizacion_finalizada" class="">Estado</label>
	</div>
      </div>
      <div class="row">
	<div class="small-6 small-centered columns text-center">
	  <input type="text" name="co_mensaje_cotizacion_finalizada" id="co_mensaje_cotizacion_finalizada" />
	</div>
      </div>
      <div class="row">
	<div class="small-6 small-centered columns text-center">
	  <button id="co_save_cotizacion_finalizada" class="button" type="submit" name="" id="">Guardar</button>
	</div>
      </div>
    </form>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>


