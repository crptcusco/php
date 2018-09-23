<div id="<?php prefix('coordinacion_solicitante_contacto_modal2') ?>" class="reveal-modal" data-reveal>

  <div class="row collapse">
    <div class="small-12 columns">
      <dl id="pestanas_cotizacion" class="tabs" data-tab> 
	<dd id="contacto-tab-panel1" class="active"><a href="#contacto-panel1">Listado</a> </dd>
	<dd id="contacto-tab-panel2"><a href="#contacto-panel2">Contacto</a></dd> 
      </dl>
    </div>
  </div>
  <div class="tabs-content" style="margin: 0">
    <div class="content active" id="contacto-panel1" style="padding: 0">
      <table id="<?php prefix('coordinacion_solicitante_contacto_modal2_tabla') ?>">
	<thead>
	  <tr>
	    <th>Nombre</th>
	    <th>Cargo</th>
	    <th>Telefono</th>
	    <th>Correo</th>
	    <th width="80">Estado</th>
	    <th width="80">Acciones</th>
	  </tr>	  
	</thead>
	<thead>
	  <tr>
	    <td><input type="text" class="search-input-text" data-column="0" style="margin:0"></td>
	    <td><input type="text" class="search-input-text" data-column="1" style="margin:0"></td>
	    <td><input type="text" class="search-input-text" data-column="2" style="margin:0"></td>
	    <td><input type="text" class="search-input-text" data-column="3" style="margin:0"></td>
	    <td></td>
	    <td></td>
	  </tr>	  
	</thead>	
      </table>
    </div>
    <div class="content" id="contacto-panel2" style="padding: 0">
      <input id="<?php prefix('coordinacion_solicitante_contacto_modal2_codigo') ?>"  value="" type="hidden">
      <div class="row collapse">
	<div class="small-2 columns">
	  <label class="right inline" for="<?php prefix('coordinacion_solicitante_contacto_modal2_nombre') ?>">Nombre: </label>
	</div>
	<div class="small-10 columns">
	  <input id="<?php prefix('coordinacion_solicitante_contacto_modal2_nombre') ?>"  value="" type="text" style="">
	</div>
      </div>

      <div class="row collapse">
	<div class="small-2 columns">
	  <label class="right inline" for="<?php prefix('coordinacion_solicitante_contacto_modal2_cargo') ?>">Cargo:</label>
	</div>
	<div class="small-4 columns">
	  <input id="<?php prefix('coordinacion_solicitante_contacto_modal2_cargo') ?>"  value="" type="text" style="">
	</div>
	<div class="small-2 columns">
	  <label class="right inline" for="<?php prefix('coordinacion_solicitante_contacto_modal2_telefono') ?>">Teléfono:</label>
	</div>
	<div class="small-4 columns">
	  <input id="<?php prefix('coordinacion_solicitante_contacto_modal2_telefono') ?>"  value="" type="text" style="">
	</div>
      </div>

      <div class="row collapse">
	<div class="small-2 columns">
	  <label class="right inline" for="<?php prefix('coordinacion_solicitante_contacto_modal2_correo') ?>">Correo:</label>
	</div>
	<div class="small-4 columns">
	  <input id="<?php prefix('coordinacion_solicitante_contacto_modal2_correo') ?>"  value="" type="text" style="">
	</div>
	<div class="small-6 columns">
	</div>
      </div>

      <div class="row collapse">
	<div class="small-2 columns">
	  <label for="<?php prefix('coordinacion_solicitante_contacto_modal2_status') ?>" class="right">Activo:</label>
	</div>
	<div class="small-1 columns">
	  <input id="<?php prefix('coordinacion_solicitante_contacto_modal2_status') ?>" class="" type="checkbox" checked>
	</div>
	<div class="small-9 columns">
	  <button id="<?php prefix('coordinacion_solicitante_contacto_modal2_save') ?>" class="right button tiny" style="margin: 0">Añadir</button>
	  <button id="<?php prefix('coordinacion_solicitante_contacto_modal2_cancel') ?>" class="right secondary  button tiny" style="margin: 0">Cancelar</button>
	</div>
      </div>  
    </div>    
  </div> 
  
  <a class="close-reveal-modal">&#215;</a>
</div>
