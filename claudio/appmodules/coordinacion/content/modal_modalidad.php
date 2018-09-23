<div id="<?php prefix('coordinacion_modalidad_modal') ?>" class="reveal-modal" data-reveal>
  <div class="row collapse">
    <div class="small-12 columns">
      <dl id="pestanas_cotizacion" class="tabs" data-tab> 
	<dd id="modalidad-tab-panel1" class="active"><a href="#modalidad-panel1">Listado</a> </dd>
	<dd id="modalidad-tab-panel2"><a href="#modalidad-panel2">Formato</a></dd> 
      </dl>
    </div>
  </div>
  <div class="tabs-content" style="margin: 0">
    <div class="content active" id="modalidad-panel1" style="padding: 0">
                               
      <table id="<?php prefix('coordinacion_modalidad_modal_tabla') ?>" width="100%">
	<thead>
	  <tr>
	    <th>Nombre</th>
	    <th width="80">Estado</th>
	    <th width="80">Acciones</th>
	  </tr>	  
	</thead>
	<thead>
	  <tr>
	    <td><input type="text" class="search-input-text" data-column="0" style="margin:0"></td>
	    <td></td>
	    <td></td>
	  </tr>	  
	</thead>	
      </table>
    </div>
    <div class="content" id="modalidad-panel2" style="padding: 0">
      <input id="<?php prefix('coordinacion_modalidad_modal_codigo') ?>"  value="" type="hidden">
      <div class="row collapse">
	<div class="small-2 columns">
	  <label class="right inline" for="<?php prefix('coordinacion_modalidad_modal_nombre') ?>">Nombre: </label>
	</div>
	<div class="small-10 columns">
	  <input id="<?php prefix('coordinacion_modalidad_modal_nombre') ?>"  value="" type="text" style="">
	</div>
      </div>

      <div class="row collapse">
	<div class="small-2 columns">
	  <label for="<?php prefix('coordinacion_modalidad_modal_status') ?>" class="right">Activo:</label>
	</div>
	<div class="small-1 columns">
	  <input id="<?php prefix('coordinacion_modalidad_modal_status') ?>" class="" type="checkbox" checked>
	</div>
	<div class="small-9 columns">
	  <button id="<?php prefix('coordinacion_modalidad_modal_save') ?>" class="right button tiny" style="margin: 0">Añadir</button>
	  <button id="<?php prefix('coordinacion_modalidad_modal_cancel') ?>" class="right secondary  button tiny" style="margin: 0">Cancelar</button>
	</div>
      </div>  
    </div>    
  </div> 

  <a class="close-reveal-modal">&#215;</a>
</div>
