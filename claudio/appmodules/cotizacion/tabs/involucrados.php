<input id="co_involucrados_accion" value="add" type="hidden">
<div class="row">
  <div class="small-3 columns">
    <label class="right" for="co_involucrados_coordinador">Coordinador:</label>
  </div>
  <div class="small-9 columns">
    <label class="" id="co_involucrados_coordinador"><?php echo $input['coordinador'] ?></label>
  </div>
</div>
<hr>
<div class="row">
  <div class="small-4 columns">
    <div class="row">
      <div class="small-6 columns">
	<div class="row">
	  <div class="small-2 columns">
	    <input id="co_involucrados_rol_cliente" class="co_involucrados_rol" type="checkbox"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="co_involucrados_rol_cliente">Cliente</label>
	  </div>
	</div>
	<div class="row">
	  <div class="small-2 columns">
	    <input id="co_involucrados_rol_solicitante" class="co_involucrados_rol" type="checkbox"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="co_involucrados_rol_solicitante">Solicitante</label>
	  </div>
	</div>
	<div class="row">
	  <div class="small-2 columns">
	    <input id="co_involucrados_rol_propietario" class="co_involucrados_rol" type="checkbox"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="co_involucrados_rol_propietario">Propietario</label>
	  </div>
	</div>
      </div>
      <div class="small-6 columns">
	<div class="row">
	  <div class="small-2 columns">
	    <input id="co_involucrados_tipo_juridico" name="co_involucrados_tipo" value="juridico" class="co_involucrados_tipo" type="radio"  checked>
	  </div>
	  <div class="small-10 columns">
	    <label for="co_involucrados_tipo_juridico">Juridico</label>
	  </div>	  
	</div>
	<div class="row">
	  <div class="small-2 columns">
	    <input id="co_involucrados_tipo_natural" name="co_involucrados_tipo" value="natural" class="co_involucrados_tipo" type="radio"  >
	  </div>
	  <div class="small-10 columns">
	    <label for="co_involucrados_tipo_natural">Natural</label>
	  </div>	  
	</div>
      </div>
    </div>
  </div>
  <div class="small-8 columns" id="co_involucrados_juridico">
    <div class="row">
      <div class="small-2 columns">
	<label class="right" for="co_involucrados_juridico_razon_social">Razon Social:</label>
      </div>
      <div class="small-1 columns text-right">	
	<a id="link_modal_co_involucrado_juridico" data-reveal-id="modal_co_involucrado_juridico" class="cld-icon-search right"></a>
      </div>
      <div class="small-9 columns">
	<select id="co_involucrados_juridico_razon_social"  class="chosen-select-deselect">
	  <option value=""></option>
	</select>
      </div>
    </div>
    <div class="row">
      <div class="small-2 columns">
	<label class="right" for="co_involucrados_juridico_contacto">Contacto:</label>
      </div>
      <div class="small-1 columns text-right">	
	<a id="link_modal_co_involucrado_juridico_contacto" data-reveal-id="modal_co_involucrado_juridico_contacto" class="cld-icon-search right"></a>
      </div>
      <div class="small-9 columns">
	<select id="co_involucrados_juridico_contacto"  class="chosen-select-deselect">
	  <option value=""></option>
	</select>
      </div>
    </div>
    <div class="row">
      <div class="small-5 large-push-3 columns" id="co_involucrados_juridico_contacto_datos" >
      </div>
      <div class="small-4 columns">
	<input type="hidden" id="co_involucrados_id" value="0">
	<button class="right button tiny info" id="co_involucrados_juridico_save">Añadir</button>
	<button class="right button tiny secondary" id="co_involucrados_juridico_cancel">Limpiar</button>
      </div>
    </div>
  </div>
  
  <div class="small-8 columns" id="co_involucrados_natural" style="display:none">
    <div class="row">
      <div class="small-2 columns">
	<label class="right" for="co_involucrados_natural_nombre">Nombre:</label>
      </div>
      <div class="small-1 columns text-right">	
	<a id="link_modal_co_involucrado_natural" data-reveal-id="modal_co_involucrado_natural" class="cld-icon-search right"></a>
      </div>
      <div class="small-9 columns">
	<select id="co_involucrados_natural_nombre"  class="chosen-select-deselect">
	  <option value=""></option>
	</select>
      </div>
    </div>
    <div class="row">
      <div class="small-5 large-push-3 columns" id="co_involucrados_natural_datos" >
      </div>
      <div class="small-4 columns">
	<button class="right button tiny info" id="co_involucrados_natural_save">Añadir</button>
	<button class="right button tiny secondary" id="co_involucrados_natural_cancel">Limpiar</button>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="small-12 columns">
    <style>
     #co_involucrados_tabla table {
       width:100%
     }
     #co_involucrados_tabla table th, #co_involucrados_tabla table td {
       border: 1px solid;
     }
     #co_involucrados_tabla table o {
       color: #5468D5;
     }
    </style>
    <div id="co_involucrados_tabla">
      <table>
	<thead>
	  <tr>
            <th>Rol</th>
	    <th>Tipo</th>
	    <th>Razon / Nombre</th>
	    <th>Ruc / Dni</th>
	    <th>Teléfono</th>
	    <th>Correo</th>
	    <th  width="130">Accion</th>
	  </tr>
	</thead>
	<tbody class="ajax">
	</tbody>
      </table>
    </div>
  </div>
</div>
<hr>

<div class="row">
  <div class="small-3 columns">
    <label class="right" for="co_involucrados_vendedor">Vendedor:</label>
  </div>
  <div class="small-9 columns">
    <div class="row">      
      <!-- <div class="small-1 columns text-right"> -->
	<!-- <a id="link_modal_co_vendedor" data-reveal-id="modal_co_vendedor" class="cld-icon-search right"></a> -->
      <!-- </div> -->      
      <div class="small-12 columns">
	<select id="co_involucrados_vendedor" name="co_involucrados_vendedor" class="chosen-select-deselect">
	  <?php if ($input['vendedor']==0) {?>
	    <option value=""></option>
	  <?php } else { ?>
	    <option value="<?php echo $input['vendedor'] ?>" selected></option>
	  <?php } ?>
	</select>
      </div>
    </div>
  </div>
</div>

