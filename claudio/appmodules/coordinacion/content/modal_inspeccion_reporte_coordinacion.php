<div id="<?php prefix('operaciones_inspeccion_modal') ?>" class="reveal-modal" data-reveal>
  
  <dl class="accordion" data-accordion>
    <dd class="accordion-navigation">
      <input id="<?php prefix('operaciones_inspeccion_modal_informe_id') ?>" type="hidden">
      <input id="<?php prefix('operaciones_inspeccion_modal_inspeccion_id') ?>" type="hidden">
      <input id="<?php prefix('operaciones_inspeccion_modal_coordinacion_id') ?>" type="hidden">
      <input id="<?php prefix('operaciones_inspeccion_modal_coordinacion_estado_id') ?>" type="hidden">
      <a href="#acoordin-inspeccion-modal-01">Personas</a>
      <div id="acoordin-inspeccion-modal-01" class="content active" style="">
        <div class="row">          
          <div class="small-2 columns">
            <label for="<?php prefix('operaciones_inspeccion_modal_perito_id') ?>"
                   class="text-right"
            >Perito:</label>
          </div>
          <div class="small-10 columns">
            <select id="<?php prefix('operaciones_inspeccion_modal_perito_id') ?>" class="chosen-select" >
            </select>
          </div>
        </div>        
        <div class="row">          
          <div class="small-2 columns">
            <label for="<?php prefix('operaciones_inspeccion_modal_consultor_id') ?>"
                   class="text-right"
                   >Consultor:</label>
          </div>
          <div class="small-10 columns">
            <select id="<?php prefix('operaciones_inspeccion_modal_consultor_id') ?>"
                    class="chosen-select" >
            </select>
          </div>
        </div>
        <div class="row">          
          <div class="small-2 columns">
            <label for="<?php prefix('operaciones_inspeccion_modal_inspector_id') ?>"
                   class="text-right">Inspector:</label>
          </div>
          <div class="small-10 columns">
            <select id="<?php prefix('operaciones_inspeccion_modal_inspector_id') ?>" class="chosen-select" >
            </select>
          </div>
        </div>
        <div class="row">
          <div class="small-2 columns">
            <label>Contactos:</label>
          </div>
          <div class="small-10 columns">
            <textarea rows="3" id="<?php prefix('operaciones_inspeccion_modal_contactos') ?>"></textarea>
          </div>
        </div>
      </div>
      <a href="#acoordin-inspeccion-modal-02">Fecha/Hora</a>
      <div id="acoordin-inspeccion-modal-02" class="content" style="">
        <div class="row collapse">
          <div class="small-2 columns">
            <label class="inline text-right" for="" style="margin:0">Fecha:</label>
          </div>
          <div class="small-10 columns">
            <input id="<?php prefix('operaciones_inspeccion_modal_fecha') ?>"
                   class="" type="text" value=""
                   style="margin:0">
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <label>Hora sss:</label>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <table width="100%" border="1">
              <thead>
                <tr>
                  <th></th>
                  <th width="150">Hora</th>
                  <th width="10"></th>
                  <th width="150" class="text-center">Minuto</th>
                  <th width="150" class="text-center">Meridiano</th>
                  <th width="100" class="text-center">Mostrar</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th rowspan="2"  class="text-right">Estimado</th>
                  <td>
                    <input id="<?php prefix('operaciones_inspeccion_modal_est_ini_ho') ?>" 
                           class="text-center only_int_numbers_clds" maxlength="2" type="text"
                           style="margin:0">
                  </td>
                  <td class="text-center">:</td>
                  <td>
                    <input id="<?php prefix('operaciones_inspeccion_modal_est_ini_mi') ?>"
                           class="text-center only_int_numbers_clds" maxlength="2" type="text"
                           style="margin:0">
                  </td>
                  <td>
                    <select id="<?php prefix('operaciones_inspeccion_modal_est_ini_me') ?>" 
                            style="margin:0">
                      <option value="am">Am</option>
                      <option value="pm">Pm</option>
                    </select>              
                  </td>
                  <td rowspan="2" class="text-center">
                    <input id="<?php prefix('operaciones_inspeccion_modal_est_mostrar') ?>"
                           type="checkbox" >
                  </td>
                </tr>
                <tr>
                  <td>
                    <input id="<?php prefix('operaciones_inspeccion_modal_est_end_ho') ?>" 
                           class="text-center only_int_numbers_clds" maxlength="2" type="text" 
                           style="margin:0">
                  </td>
                  <td class="text-center">:</td>
                  <td>
                    <input id="<?php prefix('operaciones_inspeccion_modal_est_end_mi') ?>" 
                           class="text-center only_int_numbers_clds" maxlength="2" type="text"
                           style="margin:0">
                  </td>
                  <td>
                    <select id="<?php prefix('operaciones_inspeccion_modal_est_end_me') ?>" 
                            style="margin:0">
                      <option value="am">Am</option>
                      <option value="pm">Pm</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th class="text-right">Real</th>
                  <td>
                    <input id="<?php prefix('operaciones_inspeccion_modal_rea_ho') ?>" 
                           class="text-center only_int_numbers_clds" maxlength="2" type="text"
                           style="margin:0">
                  </td>
                  <td class="text-center">:</td>
                  <td>
                    <input id="<?php prefix('operaciones_inspeccion_modal_rea_mi') ?>" 
                           class="text-center only_int_numbers_clds" type="text" maxlength="2"
                           style="margin:0">
                  </td>
                  <td>
                    <select id="<?php prefix('operaciones_inspeccion_modal_rea_me') ?>" 
                            style="margin:0">
                      <option value="am">Am</option>
                      <option value="pm">Pm</option>
                    </select>              
                  </td>
                  <td class="text-center">
                    <input id="<?php prefix('operaciones_inspeccion_modal_rea_mostrar') ?>"
                           name="<?php prefix('operaciones_inspeccion_modal_mostrar') ?>"     
                           type="checkbox">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>        
      </div>
      <a href="#acoordin-inspeccion-modal-03">Dirección</a>
      <div id="acoordin-inspeccion-modal-03" class="content" style="">
        <div class="row">
          <div class="small-12 columns">
            <label>Direccion:</label>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <div class="panel callout" style="padding-bottom: 0">
              <div class="row">
                <div class="small-4 columns ">
                  <select id="<?php prefix('operaciones_inspeccion_modal_departamento_id') ?>" class="chosen-select">
                    <option value=""></option>
                  </select>
                </div>
                <div class="small-4 columns">
                  <select id="<?php prefix('operaciones_inspeccion_modal_provincia_id') ?>" class="chosen-select">
                    <option value=""></option>
                  </select>
                </div>
                <div class="small-4 columns">
                  <select id="<?php prefix('operaciones_inspeccion_modal_distrito_id') ?>" class="chosen-select">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="small-12 columns">
                  <textarea id="<?php prefix('operaciones_inspeccion_modal_direccion') ?>"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a href="#acoordin-inspeccion-modal-04">Observaciones</a>
      <div id="acoordin-inspeccion-modal-04" class="content" style="">
        <div class="row">
          <div class="small-10 columns ">
            <input id="<?php prefix('operaciones_inspeccion_modal_observacion_text') ?>"
                   type="text" style="margin:0">
          </div>
          <div class="small-2 columns ">
            <a id="<?php prefix('operaciones_inspeccion_modal_observacion_add') ?>"
               class="button tiny info" style="margin:0">Añadir</a>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <table id="<?php prefix('operaciones_inspeccion_modal_observacion_table') ?>"
                   width="100%" border="1">
              <thead>
                <tr>
                  <th class="text-center" width="160">Fecha</th>
                  <th class="text-center" width="130">Usuario</th>
                  <th class="text-center">Mensaje</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </dd>
  </dl>
  <hr style="margin: 0 0 1em">
  <div class="row">
    <div class="small-12 columns text-right">
      <a id="<?php prefix('operaciones_inspeccion_modal_save') ?>" class="button tiny close-reveal-modal" style="position: static; margin: 0px; color: white; font-size: 0.5em;">Guardar</a>
    </div>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
