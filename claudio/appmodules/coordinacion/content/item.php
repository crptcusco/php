<div class="row collapse">
  <div class="small-5 columns">
    <?php
    echo '<h3>Coordinación: ';
    if (isset($_GET['oculto']) && $_GET['oculto'] == '1')
        echo '<a id="' . sprefix('codigo_correlativo_trigger') . '" data-reveal-id="' . sprefix('codigo_correlativo_modal') . '" >';
    echo $in['coordinacion']['codigo_correlativo'];    
    if (isset($_GET['oculto']) && $_GET['oculto'] == '1')
        echo '</a>'; 
    echo '</h3>';
    ?>
  </div>
  <div class="small-7 columns text-right">
    <?php if ( $in['coordinacion_modo'] == 'edit' ):  ?>
      <a href="./item.php?cotizacion=<?php echo $in['cotizacion_codigo']  ?>&startDataTable=<?php echo $in['startDataTable'] ?>&coordinacion=<?php echo $in['coordinacion_id'] ?>&modo=view" class="button tiny secondary" style="margin:0" id="<?php prefix('coordinacion_exit') ?>">Salir</a>
    <?php endif ?>
    <?php if ( $in['coordinacion_modo'] == 'view' ):  ?>
      <a href="./item.php?cotizacion=<?php echo $in['cotizacion_codigo']  ?>&startDataTable=<?php echo $in['startDataTable'] ?>&coordinacion=<?php echo $in['coordinacion_id'] ?>&modo=edit" class="button tiny info" style="margin:0" id="<?php prefix('coordinacion_edit') ?>">Editar</a>
    <?php endif ?>
    <?php if ( $logica->searchListaRol('Coordinador') ):  ?>
      <a href="./eliminar.php?cotizacion=<?php echo $in['cotizacion_codigo']  ?>&coordinacion=<?php echo $in['coordinacion_id'] ?>" class="button tiny alert" style="margin:0" id="<?php prefix('coordinacion_delete') ?>">Eliminar</a>
    <?php endif ?>
  </div>
</div>
<div class="row collapse">
  <div class="small-12 columns">
    <dl id="pestanas_cotizacion" class="tabs" style="background-color: #efefef" data-tab> 
      <dd id="tab-panel1" class="active"><a href="#panel1">Coordinación</a> </dd>
      <dd id="tab-panel2"><a href="#panel2">Operación</a></dd> 
    </dl>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <div class="tabs-content">

      <div class="content active" id="panel1">
        <input type="hidden" id="<?php prefix('rol') ?>" value="<?php echo $in['rol'] ?>">
        <input type="hidden" id="<?php prefix('informe_id') ?>" value="<?php echo $in['informe']['id'] ?>">
        <input type="hidden" id="<?php prefix('coordinacion_id') ?>" value="<?php echo $in['coordinacion']['id'] ?>">
        <input type="hidden" id="<?php prefix('cootizacion_id') ?>" value="<?php echo $in['coordinacion']['cotizacion_id'] ?>">
        <input type="hidden" id="<?php prefix('inspeccion_id') ?>" value="<?php echo $in['inspeccion']['id'] ?>">
        <input type="hidden" id="<?php prefix('mode') ?>" value="<?php echo $in['coordinacion_modo'] ?>">

        <div class="row">
          <div class="small-9 columns">
            <div class="row">
              <div class="small-3 columns">
                <label class="text-right" for="">Coordinador:</label>
              </div>
              <div class="small-9 columns">
                <label class="" id="<?php prefix('coordinacion_coordinador') ?>"><?php echo utf8_encode($in['coordinacion']['coordinador_nombre']) ?></label>
              </div>
            </div>
            <div class="row">
              <div class="small-3 columns">
                <label class="text-right" for="<?php prefix('coordinacion_estado_id') ?>">Estado:</label>
              </div>
              <div class="small-9 columns">
                <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
                  <select class="chosen-select"  id="<?php prefix('coordinacion_estado_id') ?>" name="coordinacion_estado_id">
                    <option value="<?php echo $in['coordinacion']['estado_id'] ?>"></option>
                  </select>
                <?php else: ?>
                  <label class=""><?php echo utf8_encode($in['coordinacion']['estado_nombre']) ?></label>
                <?php endif ?>
              </div>
            </div>                           
          </div>
          <div class="small-3 columns">
            <div class="row">
              <div class="small-12 columns text-right">
                <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?> 
                  <a id="<?php prefix('coordinacion_save') ?>" class="button" style="margin:0">Guardar</a>
                <?php endif ?>
              </div>
            </div>            
          </div>
        </div>
        

        <div class="row">
          <div class="small-3 columns">
            <label class="" for="">Solicitante:</label>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <div class="panel callout" style="padding-bottom: 0">
              <div class="row">
                <div class="small-3 columns">
                  <label class="text-right" for="">Nombre/Razon:</label>
                </div>

                <div class="small-7 columns">
                  <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
                    <div class="row collapse">
                      <div class="small-1 columns text-right">
                        <a class="cld-icon-search right" data-reveal-id="<?php prefix('coordinacion_persona_modal') ?>" id="<?php prefix('coordinacion_persona_link') ?>" tipo="solicitante"></a> 
                      </div>
                      <div class="small-11 columns">
                        <select class="chosen-select" id="<?php prefix('coordinacion_solicitante_id') ?>" name="coordinacion_solicitante_id">
                          <option value="<?php echo $in['coordinacion']['solicitante_id'] ?>"></option>
                        </select>
                      </div>
                    </div>
                  <?php else: ?>
                    <input type="hidden" id="<?php prefix('coordinacion_solicitante_id') ?>"  value="<?php echo $in['coordinacion']['solicitante_id'] ?>">
                    <label class=""><?php echo utf8_encode($in['coordinacion']['solicitante_nombre']) ?></label>
                  <?php endif ?>
                </div>
                <div class="small-2 columns">
                  <?php if ( $logica->searchListaRol('Coordinador') ):  ?> 
                    <a class="info label round" data-reveal-id="<?php prefix('coordinacion_solicitante_info') ?>" id="<?php prefix('coordinacion_solicitante_link') ?>">Información</a>
                  <?php endif ?>
                </div>
              </div>
              <div class="row">
                <div class="small-3 columns">
                  <label class="text-right" for="">Contacto:</label>
                </div>
                <div class="small-7 columns">
                  <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?> 
                    <div class="row collapse">
                      <div class="small-2 columns text-right">
                        <a class="cld-icon-search right" data-reveal-id="<?php prefix('coordinacion_solicitante_contacto_modal2') ?>" id="<?php prefix('coordinacion_solicitante_contacto_link2') ?>"></a>
                      </div>
                      <div class="small-10 columns">
                        <select class="chosen-select" id="<?php prefix('coordinacion_solicitante_contacto_id') ?>" name="coordinacion_solicitante_contacto_id">
                          <option value="<?php echo $in['coordinacion']['solicitante_contacto_id'] ?>"></option>
                        </select>
                      </div>
                    </div>
                  <?php else: ?>
                    <input type="hidden" id="<?php prefix('coordinacion_solicitante_contacto_id') ?>" value="<?php echo $in['coordinacion']['solicitante_contacto_id'] ?>">
                    <label class=""><?php echo utf8_encode($in['coordinacion']['solicitante_contacto_nombre']) ?></label>
                  <?php endif ?>      
                </div>
                <div class="small-2 columns">
                  <?php if ( $logica->searchListaRol('Coordinador') ): ?> 
                    <a class="info label round" data-reveal-id="<?php prefix('coordinacion_solicitante_contacto_info') ?>" id="<?php prefix('coordinacion_solicitante_contacto_link') ?>" style="margin-bottom: 1em">Información</a>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="small-2 columns">
            <label class="inline text-right" for="">Solicitud:</label>
          </div>
          <div class="small-3 columns">
            <?php
            if ($in['coordinacion']['solicitante_fecha'] != '') {
                $f = Utilidades::fechas_de_MysqlTimeStamp_a_array( $in['coordinacion']['solicitante_fecha'] );
                $f = $f['dia'] . '-' . $f['mes'] . '-' . $f['anio'];    
            } else {
                $f = '';
            }            
            ?>
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?> 
              <input class="datapicker-simple text-center" type="text" id="<?php prefix('coordinacion_solicitud_fecha') ?>" name="coordinacion_solicitud_fecha" value="<?php echo $f ?>" readonly>
            <?php else: ?>
              <label class="inline"><?php echo $f ?></label>
            <?php endif ?>
          </div>
          <div class="small-2 columns">
          </div>
        </div>
        <div class="row">
          <div class="small-2 columns">
            <label class="text-right" for="">Entregada por Operaciones:</label>
          </div>
          <div class="small-2 columns">
            <?php
            if ($in['coordinacion']['entrega_por_operaciones_fecha'] != '') {
                $f = Utilidades::fechas_de_MysqlTimeStamp_a_array( $in['coordinacion']['entrega_por_operaciones_fecha'] );
                $f = $f['dia'] . '-' . $f['mes'] . '-' . $f['anio'];
                if ($f == '00-00-0000') {
                    $f = '';
                }
            } else {
                $f = '';
            }
            ?>
            <?php if ( $logica->searchListaRol('EncargadoOperaciones') and $in['coordinacion_modo'] == 'edit' ):  ?> 
              <input class="datapicker-simple text-center" type="text" style="font-size: .8em!important" id="<?php prefix('coordinacion_entrega_por_operaciones_fecha') ?>" name="coordinacion_entrega_por_operaciones_fecha" value="<?php echo $f ?>" readonly>
            <?php else: ?>
              <input class="" type="hidden" style="" id="<?php prefix('coordinacion_entrega_por_operaciones_fecha') ?>" name="coordinacion_entrega_por_operaciones_fecha" value="<?php echo $f ?>" readonly>
              <label class="inline"><?php echo $f ?></label>
            <?php endif ?>
          </div>
          <div class="small-2 columns">
            <?php if ( $logica->searchListaRol('EncargadoOperaciones') and $in['coordinacion_modo'] == 'edit' ):  ?> 
              <button class="button tiny secondary clear-datapicker" item="<?php prefix('coordinacion_entrega_por_operaciones_fecha') ?>">Limpiar</button>
            <?php else: ?>
              &nbsp;
            <?php endif ?>
          </div>
          <div class="small-2 columns">
            <label class="text-right" for="">Entrega al Cliente:</label>
          </div>
          <div class="small-2 columns">
            <?php
            if ($in['coordinacion']['entrega_al_cliente_fecha'] != '') {
                $f = Utilidades::fechas_de_MysqlTimeStamp_a_array( $in['coordinacion']['entrega_al_cliente_fecha'] );
                $f = $f['dia'] . '-' . $f['mes'] . '-' . $f['anio'];
                if ($f == '00-00-0000') {
                    $f = '';
                }
            } else {
                $f = '';
            }            
            ?>
            <?php if ( $logica->searchListaRol('Coordinador') and !$logica->searchListaRol('EncargadoOperaciones') and $in['coordinacion_modo'] == 'edit' ):  ?>
              <input class="datapicker-simple text-center" type="text" style="font-size: .8em!important" id="<?php prefix('coordinacion_entrega_al_cliente_fecha') ?>" name="coordinacion_entrega_al_cliente_fecha" value="<?php echo $f ?>" readonly>
            <?php else: ?>
              <input class="" type="hidden" style="" id="<?php prefix('coordinacion_entrega_al_cliente_fecha') ?>" name="coordinacion_entrega_al_cliente_fecha" value="<?php echo $f ?>" readonly>
              <label class="inline"><?php echo $f ?></label>
            <?php endif ?>
          </div>
          <div class="small-2 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and !$logica->searchListaRol('EncargadoOperaciones') and $in['coordinacion_modo'] == 'edit' ):  ?> 
              <button class="button tiny secondary clear-datapicker" item="<?php prefix('coordinacion_entrega_al_cliente_fecha') ?>">Limpiar</button>
            <?php else: ?>
              &nbsp;
            <?php endif ?>
          </div>          
        </div>
        
        <div class="row">
          <div class="small-3 columns">
            <label class="text-right" for="">Cliente:</label>
          </div>
          <div class="small-7 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?> 
              <div class="row collapse">
                <div class="small-1 columns text-right">
                  <a class="cld-icon-search right" data-reveal-id="<?php prefix('coordinacion_persona_modal') ?>" id="<?php prefix('coordinacion_persona_link') ?>" tipo="cliente"></a> 
                </div> 
                <div class="small-11 columns">
                  <select class="chosen-select" id="<?php prefix('coordinacion_cliente_id') ?>" name="coordinacion_cliente_id">
                    <option value="<?php echo $in['coordinacion']['cliente_id'] ?>"></option>
                  </select>
                </div>
              </div>

            <?php else: ?>
              <input type="hidden" id="<?php prefix('coordinacion_cliente_id') ?>" value="<?php echo $in['coordinacion']['cliente_id'] ?>">
              <label class=""><?php echo utf8_encode($in['coordinacion']['cliente_nombre']) ?></label>
            <?php endif ?>
          </div>
          <div class="small-2 columns">
            <?php if ( $logica->searchListaRol('Coordinador') ):  ?>      
              <a data-reveal-id="<?php prefix('coordinacion_cliente_info') ?>" id="<?php prefix('coordinacion_cliente_link') ?>" class="info label round">Información</a>
            <?php endif ?>
          </div>
        </div>
        <div class="row">
          <div class="small-3 columns">
            <label class="inline text-right" for="<?php prefix('coordinacion_sucursal') ?>">Sucursal:</label>
          </div>
          <div class="small-9 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?> 
              <input type="text" value="<?php echo utf8_encode($in['coordinacion']['sucursal']) ?>"  id="<?php prefix('coordinacion_sucursal') ?>" name="coordinacion_sucursal">
            <?php else: ?>
              <label class="inline"><?php echo utf8_encode($in['coordinacion']['sucursal']) ?></label>
            <?php endif ?>
          </div>
        </div>
        <div class="row">
          <div class="small-3 columns">
            <label class="text-right" for="<?php prefix('coordinacion_modalidad_id') ?>">Formato:</label>
          </div>
          <div class="small-9 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
              <div class="row">
                <div class="small-1 columns text-right">
                  <a class="cld-icon-search right" data-reveal-id="<?php prefix('coordinacion_modalidad_modal') ?>" id="<?php prefix('coordinacion_modalidad_link') ?>"></a>
                </div>
                <div class="small-11 columns">
                  <select class="chosen-select" id="<?php prefix('coordinacion_modalidad_id') ?>" name="coordinacion_modalidad_id">
                    <option value="<?php echo $in['coordinacion']['modalidad_id'] ?>"></option>
                  </select>
                </div>
              </div>
            <?php else: ?>
              <label class=""><?php echo utf8_encode($in['coordinacion']['modalidad_nombre']) ?></label>
            <?php endif ?>
          </div>
        </div>
        <div class="row">
          <div class="small-3 columns">
            <label class="text-right" for="<?php prefix('coordinacion_tipo2_id') ?>">Tipo de Servicio:</label>
          </div>
          <div class="small-9 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
              <div class="row">
                <div class="small-1 columns text-right">
                  <a class="cld-icon-search right" data-reveal-id="<?php prefix('coordinacion_tipo2_modal') ?>" id="<?php prefix('coordinacion_tipo2_link') ?>"></a>
                </div>
                <div class="small-11 columns">
                  <select class="chosen-select" id="<?php prefix('coordinacion_tipo2_id') ?>" name="coordinacion_tipo2_id">
                    <option value="<?php echo $in['coordinacion']['tipo2_id'] ?>"></option>
                  </select>
                </div>
              </div>
            <?php else: ?>
              <label class=""><?php echo utf8_encode($in['coordinacion']['tipo2_nombre']) ?></label>
            <?php endif ?>
          </div>
        </div>

        <div class="row">
          <div class="small-3 columns">
            <label class="text-right" for="<?php prefix('coordinacion_cambio_id') ?>">Tipo de Cambio:</label>
          </div>
          <div class="small-9 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
              <div class="row">
                <div class="small-1 columns text-right">
                  <a class="cld-icon-search right" data-reveal-id="<?php prefix('coordinacion_cambio_modal') ?>" id="<?php prefix('coordinacion_cambio_link') ?>"></a>
                </div>
                <div class="small-11 columns">
                  <select class="chosen-select" id="<?php prefix('coordinacion_cambio_id') ?>" name="coordinacion_cambio_id">
                    <option value="<?php echo $in['coordinacion']['cambio_id'] ?>"></option>
                  </select>
                </div>
              </div>
            <?php else: ?>
              <label class=""><?php echo utf8_encode($in['coordinacion']['cambio_nombre']) ?></label>
            <?php endif ?>
          </div>
        </div>

        <div class="row">
          <div class="small-3 columns">
            <label class="text-right" for="<?php prefix('coordinacion_observacion') ?>">Observación (Coordinación):</label>
          </div>
          <div class="small-9 columns">
            <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
              <div class="row">
                <div class="small-12 columns">
                  <textarea rows="4"
                            id="<?php prefix('coordinacion_observacion') ?>"
                            name="coordinacion_observacion" ><?php echo utf8_encode($in['coordinacion']['observacion']) ?></textarea>
                </div>
              </div>
            <?php else: ?>
              <label class=""><?php echo utf8_encode($in['coordinacion']['cambio_nombre']) ?></label>
            <?php endif ?>
          </div>
        </div>

        <div class="row ">
          <div class="small-3 columns text-right">
            <label class=" ">Inspección:</label>
          </div>
          <?php
          $in['tipo-disabled-input'] = 'disabled';
          $in['tipo-disabled-label'] = 'color:#bfbfbf';
          if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ) {
              $in['tipo-disabled-input'] = '';
              $in['tipo-disabled-label'] = '';
          }
          if ($in['coordinacion']['tipo_id'] == '1') {
          } elseif($in['coordinacion']['tipo_id'] == '2') {
          } elseif($in['coordinacion']['tipo_id'] == '3') {
          } 
          ?>
          <div class="small-9 columns">
            <div class="row collapse">
            <div class="small-1 columns text-right">
                <input type="radio" name="coordinacion_tipo" id="<?php prefix('coordinacion_tipo_2') ?>" <?php if ($in['coordinacion']['tipo_id'] == '2') { echo 'checked'; } ?> <?php echo $in['tipo-disabled-input'] ?>>
              </div>
              <div class="small-3 columns">
                <label class="" for="<?php prefix('coordinacion_tipo_2') ?>" style="<?php  echo $in['tipo-disabled-label'] ?>">Interior</label>
              </div>
              <div class="small-1 columns text-right">
                <input type="radio" name="coordinacion_tipo" id="<?php prefix('coordinacion_tipo_1') ?>" <?php if ($in['coordinacion']['tipo_id'] == '1') { echo 'checked'; } ?> <?php echo $in['tipo-disabled-input'] ?>>
              </div>
              <div class="small-3 columns">
                <label class="" for="<?php prefix('coordinacion_tipo_1') ?>" style="<?php  echo $in['tipo-disabled-label'] ?>">Exterior</label>
              </div>
              <div class="small-1 columns text-right">
                <input type="radio" name="coordinacion_tipo" id="<?php prefix('coordinacion_tipo_3') ?>" <?php if ($in['coordinacion']['tipo_id'] == '3') { echo 'checked'; } ?> <?php echo $in['tipo-disabled-input'] ?>>
              </div>
              <div class="small-3 columns">
                <label class="" for="<?php prefix('coordinacion_tipo_3') ?>" style="<?php  echo $in['tipo-disabled-label'] ?>">Gabinete</label>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="small-12 columns">
            <label for="<?php prefix('coordinacion_bien_id') ?>">Servicio:</label>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <div class="panel callout" style="padding-bottom: 0">
              <div class="row">
                <?php if ( $logica->searchListaRol('Coordinador') and $in['coordinacion_modo'] == 'edit' ):  ?>
                  <div class="small-10 columns">
                    <select id="<?php prefix('coordinacion_bien_id') ?>"
                            class="chosen-select-deselect">
                      <option value=""></option>
                    </select>
                  </div>
                  <div class="small-2 columns text-right">
                    <a id="<?php prefix('coordinacion_bien_add') ?>"
                       class="button tiny success" style="margin:0">Añadir</a>
                  </div>
                <?php endif ?>
                <div class="small-12 columns">
                  <table id="<?php prefix('coordinacion_bien_tabla') ?>"
                         width="100%"
                  >
                    <thead>
                      <tr>
                        <th>Servicio</th>
                        <th width="100">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>      
      </div>
      
      <div class="content" id="panel2">        
        <div class="row">
          <div class="small-3 columns">
            <label class="" for="">Inspección:</label>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns">
            <div class="panel callout" style="">
              <div class="row">
                <div class="small-12 columns text-right">
                  <a class="button tiny info" style="margin:0" id="<?php prefix('coordinacion_hoja') ?>" data-reveal-id="<?php prefix('modal_preview') ?>"
                     coordinacion_id="<?php echo $in['coordinacion_id'] ?>">Ver Hoja</a>
                  <?php if ( $logica->searchListaRol('Coordinador') and  $in['coordinacion_modo'] == 'edit' ):  ?> 
                    <button id="<?php prefix('operaciones_inspeccion_edit') ?>" data-reveal-id="<?php prefix('operaciones_inspeccion_modal') ?>" class="button tiny " style="margin:0">Editar</button>
                  <?php endif ?>
                </div>
              </div>
              <table width="100%" id="<?php prefix('operaciones_inspeccion_table') ?>" border="1">
                <?php
                  include './view/inspeccion_operaciones_coordinacion_item_view.php';
                $view = new Inspeccion_Operaciones_Coordinacion_Item_View();
                echo $view->imprimir($in['inspeccion']);
                ?>
              </table>
        
            </div>
          </div>
        </div>
        
        <h3 class="text-center">Incidencias</h3>
        <div class="row">
          <div class="small-10 columns ">
            <input id="<?php prefix('operaciones_inspeccion_incidente_text') ?>"
                   type="text" style="margin:0">
          </div>
          <div class="small-2 columns ">
            <a id="<?php prefix('operaciones_inspeccion_incidente_add') ?>"
               class="button tiny info expand" style="margin:0">Añadir</a>
          </div>
        </div>              
        <table id="<?php prefix('operaciones_incidencias_table') ?>"
               width="100%" border="1">
          <thead>
            <tr>
              <th class="text-center" width="130">Fecha</th>
              <th class="text-center" width="160">Usuario</th>
              <th class="text-center">Mensaje</th>
            </tr>
          </thead>
        </table>
      </div>      
    </div>
  </div>
</div>
