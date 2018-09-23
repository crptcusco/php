<div class="row">
  <div class="small-1 columns">
    <label class="right inline" for="<?php get_prefix_montos( 'moneda_general_id' )  ?>">Moneda:</label>
  </div>
  <div class="small-2 columns select-align-cld">
     <select id="<?php get_prefix_montos( 'moneda_general_id' ) ?>" destino="<?php get_prefix_montos( 'moneda_general_monto' ) ?>" class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select">
     </select>
  </div>
  <div class="small-2 columns">
    <input type="text" id="<?php get_prefix_montos( 'moneda_general_monto' ) ?>" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda=""/>
  </div>
  <div class="small-1 columns">
    <button class="button tiny expand info" id="<?php get_prefix_montos( 'moneda_general_save' ) ?>">Cambiar</button>
  </div>
  <div class="small-1 columns">
    <label class="right inline" for="<?php get_prefix_montos( 'igv' )  ?>">IGV:</label>
  </div>
  <div class="small-1 columns">
    <input type="text" id="<?php get_prefix_montos( 'igv' ) ?>" class="only-number" value=""/>
  </div>
  <div class="small-1 small-pull-3 columns">
    <button class="button tiny expand info" id="<?php get_prefix_montos( 'igv_save' ) ?>">Cambiar</button>
  </div>
</div>
<style>
#<?php get_prefix_montos( 'tabla' ) ?> input[type="text"] ,
#<?php get_prefix_montos( 'tabla' ) ?> button
{
   margin: 0;
} 
#panel4 input[type="text"] {
   text-align: right;
}
#<?php get_prefix_montos( 'tabla' ) ?> input[type="checkbox"] {
   margin: 4px 0 0;
}
tr#<?php get_prefix_montos( 'rentabilidad' ) ?> td { 
   background-color: #F9F19C;
}

</style>
<div class="row">
  <div class="small-12 columns">
    <table border="1" style="width: 100%" role="grid" id="<?php get_prefix_montos( 'tabla' ) ?>">
      <thead>
	<tr>
	  <th width=""></th>
	  <th width="220" class="text-center">Valores</th>
	  <th width="40" class="text-center">IGV</th>
	  <th width="150" class="text-center">Subtotal</th>
	  <th width="120" class="text-center">Moneda</th>
	  <th width="100" class="text-center">Cambio a S/.</th>
	  <th width="150" class="text-center">Total</th>
	</tr>
      </thead>
      <tbody>
	<tr id="<?php get_prefix_montos( 'rentabilidad' ) ?>">
	  <td class="text-right">Rentabilidad</td>
	  <td>
	    <div class="row" >
	      <div class="small-7 small-push-5 columns">
		<input type="text" id="<?php get_prefix_montos( 'trabajo_valor_monto' ) ?>" class="only-number" value=""/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns text-center">
		<input id="<?php get_prefix_montos( 'trabajo_igv' ) ?>" type="checkbox" checked >
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'trabajo_subtotal' ) ?>" class="only-number" value="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns select-align-cld">
		<select id="<?php get_prefix_montos( 'trabajo_moneda_id' ) ?>" destino="<?php get_prefix_montos( 'trabajo_moneda_monto' ) ?>" class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select"></select>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'trabajo_moneda_monto' ) ?>" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'trabajo_total' ) ?>" class=" only-number" value="" moneda="" readonly/>
	      </div>
	    </div>	    
	  </td>
	</tr>
	<tr>
	  <td class="text-right">Fichas</td>
	  <td>
	    <div class="row">
	      <div class="small-5 columns">
		<input type="text" id="<?php get_prefix_montos( 'ficha_valor_numero' ) ?>" class="only-number" value=""/>
	      </div>
	      <div class="small-7 columns">
		<input type="text" id="<?php get_prefix_montos( 'ficha_valor_unitario' ) ?>" class="only-number" value=""/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns text-center">
		<input id="<?php get_prefix_montos( 'ficha_igv' ) ?>" type="checkbox" checked >
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'ficha_subtotal' ) ?>" class="only-number" value="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns select-align-cld">
		<select id="<?php get_prefix_montos( 'ficha_moneda_id' ) ?>" destino="<?php get_prefix_montos( 'ficha_moneda_monto' ) ?>"  class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select"></select>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'ficha_moneda_monto' ) ?>" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'ficha_total' ) ?>" class=" only-number" value="" moneda="" readonly/>
	      </div>
	    </div>	    
	  </td>
	</tr>
	<tr>
	  <td class="text-right">Viático</td>
	  <td>
	    <div class="row">
	      <div class="small-7 small-push-5 columns">
		<input type="text" id="<?php get_prefix_montos( 'viatico_valor_monto' ) ?>" class="only-number" value=""/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns text-center">
		<input id="<?php get_prefix_montos( 'viatico_igv' ) ?>" type="checkbox" checked >
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'viatico_subtotal' ) ?>" class="only-number" value="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns select-align-cld">
		<select id="<?php get_prefix_montos( 'viatico_moneda_id' ) ?>" destino="<?php get_prefix_montos( 'viatico_moneda_monto' ) ?>"  class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select"></select>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'viatico_moneda_monto' ) ?>" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'viatico_total' ) ?>" class=" only-number" value="" moneda="" readonly/>
	      </div>
	    </div>	    
	  </td>
	</tr>
	<tr>
	  <td class="text-right">SCTR</td>
	  <td>
	    <div class="row">
	      <div class="small-7 small-push-5 columns">
		<input type="text" id="<?php get_prefix_montos( 'sctr_valor_numero' ) ?>" class="only-number" value=""/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns text-center">
		<input id="<?php get_prefix_montos( 'sctr_igv' ) ?>" type="checkbox" checked  >
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'sctr_subtotal' ) ?>" class="only-number" value="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns select-align-cld">
		<select id="<?php get_prefix_montos( 'sctr_moneda_id' ) ?>" destino="<?php get_prefix_montos( 'sctr_moneda_monto' ) ?>"  class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select"></select>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'sctr_moneda_monto' ) ?>" destino="" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda="" readonly />
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'sctr_total' ) ?>" class=" only-number" value="" moneda="" readonly/>
	      </div>
	    </div>	    
	  </td>
	</tr>
	<tr>
	  <td colspan="7" class="text-center">Peritos</td>
	</tr>
	<tr id="<?php get_prefix_montos( 'peritos' ) ?>">
	  <td>
	    <input type="hidden" id="<?php get_prefix_montos( 'perito_pago_id' ) ?>" value="0">
	    <button id="<?php get_prefix_montos( 'peritos_save' ) ?>" class="button tiny expand  success">Añadir</button>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-7 small-push-5 columns">
		<input type="text" id="<?php get_prefix_montos( 'perito_valor_monto' ) ?>" class="only-number" value=""/>
	      </div>
	    </div>	    
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns text-center">
		<input id="<?php get_prefix_montos( 'perito_igv' ) ?>" type="checkbox" checked  >
	      </div>
	    </div>	    
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'perito_subtotal' ) ?>" class="only-number" value="" readonly/>
	      </div>
	    </div>	    
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns select-align-cld">
		<select id="<?php get_prefix_montos( 'perito_moneda_id' ) ?>" destino="<?php get_prefix_montos( 'perito_moneda_monto' ) ?>" class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select"></select>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'perito_moneda_monto' ) ?>" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda="" readonly/>
	      </div>
	    </div>
	  </td>
	  <td>
	    <div class="row">
	      <div class="small-12 columns">
		<input type="text" id="<?php get_prefix_montos( 'perito_total' ) ?>" class=" only-number" value="" moneda="" readonly/>
	      </div>
	    </div>	    
	  </td>
	</tr>
	<tr>
	  <td>
	    <button id="<?php get_prefix_montos( 'peritos_cancel' ) ?>" class="button tiny expand  secondary">Cancelar</button>
	  </td>
	  <td colspan="2">
	    <div class="row">
	      <div class="small-2 columns text-right">	
		<a id="<?php get_prefix_montos( 'perito_link' ) ?>" data-reveal-id="<?php get_prefix_montos( 'perito_modal' ) ?>" class="cld-icon-search right"></a>
	      </div>
	      <div class="small-10 columns select-align-cld">
		<select id="<?php get_prefix_montos( 'perito_id' ) ?>"  class="chosen-select">
		</select>
	      </div>	      
	    </div>
	  </td>
	  <td colspan="4"></td>
	</tr>
      </tbody>
    </table>
  </div>
</div>

<hr>

<div class="row">
  <div class="small-1 columns">
    <label class="right inline" for="<?php get_prefix_montos( 'moneda_total_id' )  ?>">Moneda:</label>
  </div>
  <div class="small-2 columns select-align-cld">
     <select id="<?php get_prefix_montos( 'moneda_total_id' ) ?>" destino="<?php get_prefix_montos( 'moneda_total_monto' ) ?>" class="<?php get_prefix_montos( 'moneda' ) ?> chosen-select"></select>
  </div>
  <div class="small-2 columns">
    <input type="text" id="<?php get_prefix_montos( 'moneda_total_monto' ) ?>" class="<?php get_prefix_montos( 'monto_valor' ) ?> only-number" value="" moneda="" readonly/>
  </div>
  <div class="small-1 columns">
    <button class="button tiny expand  success" id="<?php get_prefix_montos( 'total_calcular' ) ?>">Calcular</button>
  </div>
  <div class="small-2 columns">
    <input type="text" id="<?php get_prefix_montos( 'total' ) ?>" class="only-number" value=""/>
  </div>
  <div class="small-2 small-pull-2 columns">
  </div>  
</div>

<hr>

<?php 
function get_prefix_montos( $name ) {
  echo 'co_montos_field_' . $name;
}
 ?>
