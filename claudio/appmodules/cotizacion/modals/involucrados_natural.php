<div id="modal_co_involucrado_natural" class="reveal-modal" data-reveal>
  <h2>Personas Naturales</h2>
  
  <div class="row collapse">
    <div class="small-2 columns">
      <input id="<?php get_prefix('id') ?>"  value="0" type="hidden">
      <label class="right inline no-margin" for="<?php get_prefix('nombre') ?>">Nombre: </label>
    </div>
    <div class="small-10 columns">
      <input id="<?php get_prefix('nombre') ?>" class="no-margin" value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php get_prefix('documento_tipo') ?>">Documento:</label>
    </div>
    <div class="small-4 columns">
	<select class="chosen-select" id="<?php get_prefix('documento_tipo') ?>">
	</select>
    </div>
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php get_prefix('documento_numero') ?>">Número:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php get_prefix('documento_numero') ?>" class="no-margin"  value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php get_prefix('direccion') ?>">Dirección:</label>
    </div>
    <div class="small-10 columns">
      <input id="<?php get_prefix('direccion') ?>" class="no-margin" value="" type="text" style="">
    </div>
  </div>

  <div class="row collapse">
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php get_prefix('telefono') ?>">Teléfono:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php get_prefix('telefono') ?>" class="no-margin" value="" type="text" style="">
    </div>
    <div class="small-2 columns">
      <label class="right inline no-margin" for="<?php get_prefix('correo') ?>">Correo:</label>
    </div>
    <div class="small-4 columns">
      <input id="<?php get_prefix('correo') ?>" class="no-margin" value="" type="text" style="">
    </div>
  </div>
  <div class="row collapse">
    <div class="small-2 columns">
      <label for="<?php get_prefix('activo') ?>" class="right">Activo:</label>
    </div>
    <div class="small-1 columns">
      <input id="<?php get_prefix('activo') ?>" class="no-margin" type="checkbox" checked>
    </div>
    <div class="small-9 columns">
      <button id="<?php get_prefix('save') ?>" class="right button no-margin tiny">Añadir</button>
      <button id="<?php get_prefix('cancel') ?>" class="right secondary button no-margin tiny">Cancelar</button>
    </div>
  </div>
  <div class="row collapse">
    <div class="small-12 columns">
      <style>
       #tabla_involucrado_natural input.active,
       #tabla_involucrado_natural select.active
       {
           background-color: #aaffa9;
       }
       #tabla_involucrado_natural input,
       #tabla_involucrado_natural select
       {
           font-size: 0.8em;
       }
       #tabla_involucrado_natural td,
       #tabla_involucrado_natural th
       {
           padding: 0;
           font-size: 0.8em;
       }
      </style>      
      <table id="tabla_involucrado_natural">
        <thead>
          <tr>
            <?php $i = -1 ?>
            <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
            <td><!-- <?php echo ++$i ?> --></td>
            <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
            <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
            <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
            <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
            <td colspan="2">
              <select class="no-margin  search-input-select"
                      data-column="<?php echo ++$i ?>">
                <option value=""></option>
                <option value="01">Activado</option>
                <option value="00">Desactivado</option>
              </select>
            </td>
            <!-- <?php echo ++$i ?> -->            
          </tr>
          <tr>
            <th width="190">Nombre</th>
            <th>Tipo Doc.</th>
            <th>Documento</th>
            <th width="190">Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Estado</th>
            <th width="20"></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <a class="close-reveal-modal">&#215;</a>
</div>

<?php
function get_prefix($name) {
  echo 'modal_co_involucrado_natural_' . $name;
}
?>

