<?php $group = 'co_montos'; ?>
<style>
#panel4 input[type="text"] {
   text-align: right;
 }
 fieldset {
   display:none!important;
 }
 fieldset:hover {
   background-color: #e8e8e8;
 }
 fieldset button {
   margin:0!important;
 }
 fieldset input[type="radio"] {
   margin: 0.8rem 0 1rem;
   padding: 0.5625rem 0;
 }
   fieldset .edit
 , fieldset .delete {
   font-size: 0.9em;
 } 
</style>

<!-- <div class="row">
     <div class="small-3 columns">
     <label class="inline right">Moneda:</label>
     </div>
     <div class="small-2 columns">
     <select id="<?php prefix( 'moneda_general_id' ) ?>" destino="<?php prefix( 'moneda_general_monto' ) ?>" class="<?php prefix( 'moneda' ) ?> chosen-select">
     </select>	    
     </div>
     <div class="small-2 columns">
     <input type="text" id="<?php prefix( 'moneda_general_monto' ) ?>" class="<?php prefix( 'monto_valor' ) ?> only-number" value="" moneda=""/>
     </div>
     <div class="small-2 columns">
     <button class="button tiny expand info" id="<?php prefix( 'moneda_general_save' ) ?>">Cambiar</button>
     </div>
     <div class="small-3 columns">
     </div>
     </div> -->

<div class="row">
  <div class="small-2 columns">
    <label class="right">Desgloce:</label>
  </div>
  <div class="small-10 columns">
    <select id="co_desglose" name="co_desglose" class="chosen-select">
      <?php if ($input['desglose'] == 0) { ?>
        <option value=""></option>
      <?php } else { ?>
        <option value="<?php echo $input['desglose'] ?>" selected></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="row">
  <div class="small-2 columns">
    <label class="inline right">Total:</label>
  </div>
  <div class="small-2 columns">
    <input name="montos_sin" type="text" id="<?php prefix( 'total_sin_igv' ) ?>" class="only-number" readonly="readonly" value=""/>
  </div>
  <div class="small-1 columns text-right">
    <label for="<?php prefix( 'total_igv' ) ?>" class="inline">IGV:</label>
  </div>
  <div class="small-1 columns">
    <input type="checkbox" name="montos_igv_si" id="<?php prefix( 'total_igv' ) ?>" checked style="margin: 0.6em 0 0"/>
    <input type="hidden"  name="montos_de" id="<?php prefix( 'total_igv_direccion' ) ?>" value="sin">
    <input type="hidden" name="montos_igv_monto" id="<?php prefix( 'igv_oculto' ) ?>" value=""/>
  </div>
  <div class="small-2 columns">
    <input type="text" name="montos_con" id="<?php prefix( 'total_con_igv' ) ?>" class="only-number" value="" readonly="readonly"/>
  </div>
  <div class="small-2 columns select-align-cld">
    <select name="montos_moneda_id" id="<?php prefix( 'total_moneda' ) ?>" destino="<?php prefix( 'total_moneda_monto' ) ?>"  class="<?php prefix( 'moneda' ) ?> chosen-select">
    </select>	    
  </div>
  <div class="small-2 columns">
    <input name="montos_cambio" type="text" id="<?php prefix( 'total_moneda_monto' ) ?>"  value="">
  </div>
</div>
<style>
 #<?php prefix('servicios') ?> {
     width: 100%;
 }
 #<?php prefix('servicios') ?>  .acciones{
     font-size: .7em;
 }
 #<?php prefix('servicios') ?> tr.active{
     background-color: rgba(42, 179, 42, 0.48);
 }
 #<?php prefix('servicios') ?> tr.delete{
     background-color: #FEC7C7;
 }
 #co_servicios_descripcion,
 #<?php prefix('servicios') ?> tr pre
 {
     font-size: .8em;
     font-family: monospace,monospace;
 }
</style>

<div class="row">
  <h3 class="text-center">Servicios</h3>
  <div class="large-12 columns">
    <div class="row">
      <div class="small-2 columns">
        <label class="right">Descripción:</label>
      </div>
      <div class="small-10 columns">
        <textarea id="co_servicios_descripcion" rows="4"></textarea>
      </div>  
    </div>
    <div class="row">
      <div class="small-2 columns">
        <label class="right inline">Sub-Total:</label>
      </div>
      <div class="small-2 columns">
        <input id="co_servicios_subtotal" class="only-number" type="text">
      </div>
      <div class="small-8 columns">
        <input id="co_servicios_id" value="0" class="" type="hidden">
        <a id="co_servicios_clear" class="left button tiny secondary">Limpiar</a>
        <a id="co_servicios_save" class="left button tiny info ">Añadir</a>
      </div>  
    </div>    
  </div>
</div>

<div class="row">
  <table id="<?php prefix('servicios') ?>">
    <thead>
      <tr>
        <th>Descripción</th>
        <th width="100" class="text-center">Sub-Total</th>
        <th width="120" class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
