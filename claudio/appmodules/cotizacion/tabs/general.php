<input type="hidden" id="co_id"  name="id" value="<?php echo $input['id'] ?>">
<div class="row">
    <div class="small-3 columns">
        <label class="right">Codigo de Cotización:</label>
    </div>
    <div class="small-9 columns">
        <input type="hidden" id="co_codigo" name="co_codigo" value="<?php echo $input['codigo_cotizacion'] ?>">
        <span ><?php echo $input['codigo_cotizacion_str'] ?></span>
    </div>
</div>

<div class="row">
    <div class="small-3 columns">
        <label for="co_actualizacion" class="right">Actualización:</label>
    </div>
    <div class="small-9 columns">
        <?php
        if ($input['actualizacion'] == 0) {
            $checkbox = '';
        } elseif ($input['actualizacion'] == 1) {
            $checkbox = 'checked';
        }
        ?>
        <input id="co_actualizacion" name="co_actualizacion" type="checkbox" <?php echo $checkbox ?> >
    </div>
</div>

<div class="row">
    <div class="small-3 columns">
        <label for="co_tipo_cotizacion" class="right">Tipo de Cotización:</label>
    </div>
    <div class="small-9 columns">
	<select id="co_tipo_cotizacion" name="co_tipo_cotizacion" class="chosen-select">
            <?php if ($input['tipo_cotizacion'] == 0) { ?>
                <option value=""></option>
            <?php } else { ?>
                <option value="<?php echo $input['tipo_cotizacion'] ?>" selected></option>
            <?php } ?>
	</select>
    </div>
</div>

<div class="row">
    <div class="small-3 columns">
        <label for="co_tipo_servicio" class="right">Tipo de Servicio:</label>
    </div>
    <div class="small-9 columns">
        <div class="row">
            <div class="small-1 columns text-right" id="content_co_tipo_servicio">	
                <a id="link_co_tipo_servicio" data-reveal-id="modal_co_tipo_servicio" class="cld-icon-search right"></a>
            </div>
            <div class="small-11 columns">
                <select id="co_tipo_servicio" name="co_tipo_servicio" class="chosen-select">
                    <?php if ($input['tipo_servicio'] == 0) { ?>
                        <option value=""></option>
                    <?php } else { ?>
                        <option value="<?php echo $input['tipo_servicio'] ?>" selected></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="small-3 columns">
        <label for="co_estado_cotizacion" class="right">Estado de Cotización:</label>
    </div>
    <div class="small-9 columns">
        <select id="co_estado_cotizacion" name="co_estado_cotizacion" class="chosen-select">
            <?php if ($input['estado_cotizacion'] == 0) { ?>
                <option value=""></option>
            <?php } else { ?>
                <option value="<?php echo $input['estado_cotizacion'] ?>" selected></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="small-3 columns">
        <label for="right-label" class="right">Adjunto:</label>
    </div>
    <div class="small-9 columns">
        <div id="co_adjunto_view" class="text-center"></div>
        <div id="co_adjunto_update" class="ax-uploader"></div>
    </div>
</div>
<!--<div class="row" id="<?php prefix('sub_categoria_mueble_descripcion_content') ?>">
    <div class="small-3 columns">
        <label for="<?php prefix('sub_categoria_mueble_descripcion') ?>" class="right">Requerimientos:</label>
    </div>
    <div class="small-9 columns">
        <textarea id="<?php prefix('sub_categoria_mueble_descripcion') ?>"></textarea>
    </div>      
</div>-->
<div class="row">
    <div class="large-12 columns">
      <a class="button button-blue tiny" href="reporte/generar_docx.php?codigo=<?php echo $input['codigo_cotizacion'] ?>">Generar Word</a>
    </div>
</div>
