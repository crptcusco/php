<?php $group_old = $group; ?>
<div id="<?php prefix('vendedor_modal') ?>" class="reveal-modal" data-reveal>
  <?php $group = 've_propuesta_vendedor_modal'; ?>
  <h2>Vendedor</h2>
  <input id="<?php prefix('vendedor_id') ?>" value="" type="hidden">
  <input id="<?php prefix('vendedor_rol_id') ?>" value="" type="hidden">
  <div class="row">
    <div class="small-2 columns text-right">
      <label for="<?php prefix('nombre') ?>" class="inline no-margin">NOMBRE:</label>
    </div>
    <div class="small-10 columns ">
      <input id="<?php prefix('nombre') ?>" class="no-margin" type="text">
    </div>    
  </div>
  <div class="row">
    <div class="small-2 columns text-right">
      <label for="<?php prefix('telefono') ?>" class="inline no-margin">TELÉFONO:</label>
    </div>
    <div class="small-4 columns ">
      <input id="<?php prefix('telefono') ?>" class="no-margin" type="text">
    </div>
    <div class="small-2 columns text-right">
      <label for="<?php prefix('correo') ?>" class="inline no-margin">CORREO:</label>
    </div>
    <div class="small-4 columns ">
      <input id="<?php prefix('correo') ?>" class="no-margin" type="text">
    </div>
  </div>
  <div class="row <?php prefix('user') ?>">
    <div class="small-2 columns text-right">
      <label for="<?php prefix('login') ?>" class="inline no-margin">LOGIN:</label>
    </div>
    <div class="small-4 columns ">
      <input id="<?php prefix('login') ?>" class="no-margin" type="text">
    </div>
    <div class="small-2 columns text-right">
      <label for="<?php prefix('password') ?>" class="no-margin">PASSWORD:</label>
      <input id="<?php prefix('password_save') ?>" class="no-margin" type="checkbox" checked>
    </div>
    <div class="small-4 columns">
      <input id="<?php prefix('password') ?>" class="no-margin" type="password">
    </div>
  </div>
  <div class="row">
    <div class="small-2 columns text-right">
      <label for="<?php prefix('estado') ?>" class="no-margin">ACTIVO:</label>
    </div>
    <div class="small-1 columns">
      <input id="<?php prefix('estado') ?>" class="no-margin" type="checkbox" checked>
    </div>    
    <div class="small-9 columns text-right">
      <button id="<?php prefix('save') ?>" class="right button tiny no-margin">GUARDAR</button>
      <button id="<?php prefix('cancel') ?>" class="right secondary button tiny no-margin <?php prefix('user') ?> ">CANCELAR</button>
    </div>
  </div>
  <div class="<?php prefix('user') ?>" id="<?php prefix('tabla') ?>">
    <table width='100%' border='1'>
      <thead>
	<tr>
	  <TH>NOMBRE</TH>
	  <TH>TELÉFONO</TH>
	  <TH>CORREO</TH>
	  <TH>LOGIN</TH>
	  <TH>ESTADO</TH>
	  <TH>ACCIONES</TH>
	</tr>
      </thead>
      <tbody>	
      </tbody>
    </table>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>
<?php $group = $group_old; ?>
