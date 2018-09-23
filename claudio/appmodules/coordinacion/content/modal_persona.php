<div id="<?php prefix('coordinacion_persona_modal') ?>" class="reveal-modal" data-reveal>
  <input type="hidden" id="<?php prefix('coordinacion_persona_modal_rol') ?>">

  <div class="row">
    <div class="small-1 columns"></div>
    <div class="small-4 columns">
      <div class="row collapse">
        <div class="small-2 columns text-right">
          <input type="radio" id="<?php prefix('coordinacion_persona_modal_tipo_juridica') ?>" name="coordinacion_persona_modal_tipo">
        </div>
        <div class="small-4 columns">
          <label for="<?php prefix('coordinacion_persona_modal_tipo_juridica') ?>">Jurídica</label>
        </div>
        <div class="small-2 columns text-right">
          <input type="radio" id="<?php prefix('coordinacion_persona_modal_tipo_natural') ?>" name="coordinacion_persona_modal_tipo">
        </div>
        <div class="small-4 columns">
          <label for="<?php prefix('coordinacion_persona_modal_tipo_natural') ?>">Natural</label>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row collapse">
    <div class="small-12 columns">
      <dl id="pestanas_cotizacion" class="tabs" data-tab> 
        <dd id="persona-tab-panel1" class="active"><a href="#persona-panel1">Listado</a></dd>
        <dd id="persona-tab-panel2"><a href="#persona-panel2">Añadir</a></dd>
      </dl>
    </div>
  </div>
  <div class="row">
    <div class="small-12 columns">
      <div class="tabs-content">
        <div class="content active" id="persona-panel1">
          <div class="<?php prefix('coordinacion_persona_modal_juridica_tabla_div') ?>">
            <table id="<?php prefix('coordinacion_persona_modal_juridica_tabla') ?>" style="margin:0;width:100%">
              <thead>
                <tr>
                  <th>Razon</th>
                  <th width="80">Ruc</th>
                  <th width="80">Clasificacion</th>
                  <th width="80">Actividad</th>
                  <th width="80">Grupo</th>
                  <th width="80">Acciones</th>
                </tr>  
              </thead>
              <thead>
                <tr>
                  <td><input type="text" class="search-input-text" data-column="0" style="margin:0"></td>
                  <td><input type="text" class="search-input-text" data-column="1" style="margin:0"></td>
                  <td><input type="text" class="search-input-text" data-column="2" style="margin:0"></td>
                  <td><input type="text" class="search-input-text" data-column="3" style="margin:0"></td>
                  <td><input type="text" class="search-input-text" data-column="4" style="margin:0"></td>
                  <td></td>
                </tr>  
              </thead>
            </table>        
          </div>
          <div class="<?php prefix('coordinacion_persona_modal_natural_tabla_div') ?>">
            <table id="<?php prefix('coordinacion_persona_modal_natural_tabla') ?>" style="margin:0;width:100%">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th width="80">Documento</th>
                  <th width="80">Telefono</th>
                  <th width="80">Correo</th>
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
                </tr>  
              </thead>
            </table>
          </div>
        </div>
        <div class="content" id="persona-panel2">
          <div class="<?php prefix('coordinacion_persona_modal_juridica_tabla_div') ?>">

	    <input id="<?php prefix('coordinacion_persona_modal_juridica_form_id') ?>"  value="0" type="hidden">
	    <div class="row collapse">
	      <div class="small-2 columns">      
	        <label class="right inline" for="<?php prefix('coordinacion_persona_modal_juridica_form_razon') ?>">Razón: </label>
	      </div>
	      <div class="small-10 columns">
	        <input id="<?php prefix('coordinacion_persona_modal_juridica_form_razon') ?>"  value="" type="text" style="">
	      </div>
	    </div>
	    <div class="row collapse">
	      <div class="small-2 columns">
	        <label class="right inline" for="<?php prefix('coordinacion_persona_modal_juridica_form_ruc') ?>">Ruc: </label>
	      </div>
	      <div class="small-4 columns">
	        <input id="<?php prefix('coordinacion_persona_modal_juridica_form_ruc') ?>"  value="" type="text" style="">
	      </div>
	      <div class="small-2 columns">
	        <label class="right inline" for="<?php prefix('coordinacion_persona_modal_juridica_form_telefono') ?>">Teléfono: </label>
	      </div>
	      <div class="small-4 columns">
	        <input id="<?php prefix('coordinacion_persona_modal_juridica_form_telefono') ?>"  value="" type="text" style="">
	      </div>
	    </div>
	    <div class="row collapse">
	      <div class="small-2 columns">
	        <label class="right inline" for="<?php prefix('coordinacion_persona_modal_juridica_form_direccion') ?>">Dirección: </label>
	      </div>
	      <div class="small-10 columns">
	        <input id="<?php prefix('coordinacion_persona_modal_juridica_form_direccion') ?>"  value="" type="text" style="">
	      </div>
	    </div>
	    <div class="row collapse">
	      <div class="small-2 columns">
	        <label class="right" for="<?php prefix('coordinacion_persona_modal_juridica_form_clasificacion') ?>">Clasificación: </label>
	      </div>
	      <div class="small-4 columns">
	        <select id="<?php prefix('coordinacion_persona_modal_juridica_form_clasificacion') ?>" class="chosen-select">
	        </select>
	      </div>
	      <div class="small-2 columns">
	        <label class="right" for="<?php prefix('coordinacion_persona_modal_juridica_form_actividad') ?>">Actividad: </label>
	      </div>
	      <div class="small-4 columns">
	        <select id="<?php prefix('coordinacion_persona_modal_juridica_form_actividad') ?>" class="chosen-select-deselect">
	        </select>
	      </div>
	    </div>
	    <div class="row collapse">
	      <div class="small-2 columns">
	        <label class="right" for="<?php prefix('coordinacion_persona_modal_juridica_form_grupo') ?>">Grupo: </label>
	      </div>
	      <div class="small-4 columns">
	        <select id="<?php prefix('coordinacion_persona_modal_juridica_form_grupo') ?>" class="chosen-select-deselect">
		  <option value="0"></option>
	        </select>
	      </div>
	      <div class="small-6 columns">
	      </div>
	    </div>
	    <div class="row collapse">
	      <div class="small-2 columns">
	        <label for="<?php prefix('coordinacion_persona_modal_juridica_form_status') ?>" class="right">Activo:</label>
	      </div>
	      <div class="small-1 columns">
	        <input id="<?php prefix('coordinacion_persona_modal_juridica_form_status') ?>" class="" type="checkbox" checked>
	      </div>
	      <div class="small-9 columns">
	        <button id="<?php prefix('coordinacion_persona_modal_juridica_form_save') ?>" class="right button tiny">Añadir</button>
	        <button id="<?php prefix('coordinacion_persona_modal_juridica_form_cancel') ?>" class="right secondary  button tiny">Cancelar</button>
	      </div>
	    </div>            
           
          </div>
          
          <div class="<?php prefix('coordinacion_persona_modal_natural_tabla_div') ?>">
            <div class="row collapse">
              <div class="small-2 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_id') ?>"  value="0" type="hidden">
                <label class="right inline" for="<?php prefix('coordinacion_persona_modal_natural_form_nombre') ?>">Nombre: </label>
              </div>
              <div class="small-10 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_nombre') ?>"  value="" type="text" style="">
              </div>
            </div>
            <div class="row collapse">
              <div class="small-2 columns">
                <label class="right inline" for="<?php prefix('coordinacion_persona_modal_natural_form_documento_tipo') ?>">Documento:</label>
              </div>
              <div class="small-4 columns">
	        <select class="chosen-select" id="<?php prefix('coordinacion_persona_modal_natural_form_documento_tipo') ?>">
	        </select>
              </div>
              <div class="small-2 columns">
                <label class="right inline" for="<?php prefix('coordinacion_persona_modal_natural_form_documento_numero') ?>">Número:</label>
              </div>
              <div class="small-4 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_documento_numero') ?>"  value="" type="text" style="">
              </div>
            </div>

            <div class="row collapse">
              <div class="small-2 columns">
                <label class="right inline" for="<?php prefix('coordinacion_persona_modal_natural_form_direccion') ?>">Dirección:</label>
              </div>
              <div class="small-10 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_direccion') ?>"  value="" type="text" style="">
              </div>
            </div>

            <div class="row collapse">
              <div class="small-2 columns">
                <label class="right inline" for="<?php prefix('coordinacion_persona_modal_natural_form_telefono') ?>">Teléfono:</label>
              </div>
              <div class="small-4 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_telefono') ?>"  value="" type="text" style="">
              </div>
              <div class="small-2 columns">
                <label class="right inline" for="<?php prefix('coordinacion_persona_modal_natural_form_correo') ?>">Correo:</label>
              </div>
              <div class="small-4 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_correo') ?>"  value="" type="text" style="">
              </div>
            </div>
            <div class="row collapse">
              <div class="small-2 columns">
                <label for="<?php prefix('coordinacion_persona_modal_natural_form_activo') ?>" class="right">Activo:</label>
              </div>
              <div class="small-1 columns">
                <input id="<?php prefix('coordinacion_persona_modal_natural_form_activo') ?>" class="" type="checkbox" checked>
              </div>
              <div class="small-9 columns">
                <button id="<?php prefix('coordinacion_persona_modal_natural_form_save') ?>" class="right button tiny">Añadir</button>
                <button id="<?php prefix('coordinacion_persona_modal_natural_form_cancel') ?>" class="right secondary  button tiny">Cancelar</button>
              </div>
            </div>
            
          </div>          
        </div>        
      </div>
    </div>
  </div>
 
  <a class="close-reveal-modal">&#215;</a>
</div>
