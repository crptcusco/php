<?php $group= 'co_bienes' ?>
<div class="row">
  <div class="small-2 columns">
    <div class="row">
      <div class="small-2 columns">
	<input id="<?php prefix( 'categoria_mueble_radio' ) ?>" class="<?php prefix( 'categoria_radio' ) ?>" name="<?php prefix( 'categoria_radio' ) ?>" type="radio"  checked  >
      </div>
      <div class="small-10 columns">
	<label for="<?php prefix( 'categoria_mueble_radio' ) ?>">Mueble</label>
      </div>      
    </div>
    <div class="row">
      <div class="small-2 columns">
	<input id="<?php prefix( 'categoria_inmueble_radio' ) ?>" class="<?php prefix( 'categoria_radio' ) ?>" name="<?php prefix( 'categoria_radio' ) ?>" type="radio">
      </div>
      <div class="small-10 columns">
	<label for="<?php prefix( 'categoria_inmueble_radio' ) ?>">Inmuebles</label>
      </div>      
    </div>
    <div class="row">
      <div class="small-2 columns">
	<input id="<?php prefix( 'categoria_masivo_radio' ) ?>" class="<?php prefix( 'categoria_radio' ) ?>" name="<?php prefix( 'categoria_radio' ) ?>" type="radio">
      </div>
      <div class="small-10 columns">
	<label for="<?php prefix( 'categoria_masivo_radio' ) ?>">Masivos</label>
      </div>      
    </div>
  </div>
  <div class="small-2 columns">
    <div id="<?php prefix( 'categoria_mueble_content' ) ?>" class="<?php prefix( 'categoria_content' ) ?>">
      <select id="<?php prefix( 'sub_categoria_mueble' ) ?>" class="chosen-select">
	<option value="1" >Maquinaria</option>
	<option value="2">Vehiculo</option>
	<option value="3">Equipo</option>
	<option value="4">Otros</option>
      </select>
    </div>
    <div id="<?php prefix( 'categoria_inmueble_content' ) ?>" class="<?php prefix( 'categoria_content' ) ?>" style="display:none">
      <select id="<?php prefix( 'sub_categoria_inmueble' ) ?>" class="chosen-select">
	<option value="" ></option>
      </select>
      <div class="">
	<a id="<?php prefix( 'sub_categoria_inmueble_link' ) ?>" data-reveal-id="<?php prefix( 'sub_categoria_inmueble_modal' ) ?>" class="cld-icon-search right"></a>
      </div>
    </div>
    <div id="<?php prefix( 'categoria_masivo_content' ) ?>" class="<?php prefix( 'categoria_content' ) ?>" style="display:none">
    </div>
  </div>
  <div class="small-8 columns">
    <div id="<?php prefix( 'sub_categoria_muebles_content' ) ?>"  class="<?php prefix( 'sub_categoria_content' ) ?>">
      <input type="hidden" id="<?php prefix( 'sub_categoria_muebles_id' ) ?>" value="0">
      <div class="row" id="<?php prefix( 'sub_categoria_mueble_tipo_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_mueble_tipo' ) ?>" class="right">Tipo:</label>
	</div>
	<div class="small-1 columns text-right">
	  <a id="<?php prefix( 'sub_categoria_mueble_tipo_link' ) ?>" data-reveal-id="<?php prefix( 'sub_categoria_mueble_tipo_modal' ) ?>" class="cld-icon-search right"></a>
	</div>
	<div class="small-8 columns">
	  <select id="<?php prefix( 'sub_categoria_mueble_tipo' ) ?>" class="chosen-select-deselect">
	    <option value=""></option>
	  </select>
	</div>
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_mueble_marca_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_mueble_marca' ) ?>" class="right">Marca:</label>
	</div>
	<div class="small-1 columns text-right">
	  <a id="<?php prefix( 'sub_categoria_mueble_marca_link' ) ?>" data-reveal-id="<?php prefix( 'sub_categoria_mueble_marca_modal' ) ?>" class="cld-icon-search right"></a>
	</div>
	<div class="small-8 columns">
	  <select id="<?php prefix( 'sub_categoria_mueble_marca' ) ?>" class="chosen-select-deselect">
	    <option value=""></option>
	  </select>
	</div>
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_mueble_modelo_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_mueble_modelo' ) ?>" class="right">Modelo:</label>
	</div>
	<div class="small-1 columns text-right">
	  <a id="<?php prefix( 'sub_categoria_mueble_modelo_link' ) ?>" data-reveal-id="<?php prefix( 'sub_categoria_mueble_modelo_modal' ) ?>" class="cld-icon-search right"></a>
	</div>
	<div class="small-8 columns">
	  <select id="<?php prefix( 'sub_categoria_mueble_modelo' ) ?>" class="chosen-select-deselect">
	    <option value=""></option>
	  </select>
	</div>
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_mueble_descripcion_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_mueble_descripcion' ) ?>" class="right">Descripción:</label>
	</div>
	<div class="small-9 columns">
	  <textarea id="<?php prefix( 'sub_categoria_mueble_descripcion' ) ?>"></textarea>
	</div>      
      </div>
      <div class="row">
	<div class="small-12 columns">
	  <button class="right button tiny info" id="<?php prefix( 'sub_categoria_mueble_add' ) ?>">Añadir</button>
	  <button class="right button tiny secondary" id="<?php prefix( 'sub_categoria_mueble_clear' ) ?>">Limpiar</button>
	</div>
      </div>
    </div>
    <div id="<?php prefix( 'sub_categoria_inmuebles_content' ) ?>"  class="<?php prefix( 'sub_categoria_content' ) ?>" style="display:none">
      <input type="hidden" id="<?php prefix( 'sub_categoria_inmuebles_id' ) ?>" value="0">
      <div class="row" id="<?php prefix( 'sub_categoria_inmueble_departamento_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_inmueble_departamento' ) ?>" class="right">Departamento:</label>
	</div>
	<div class="small-9 columns">
	  <select id="<?php prefix( 'sub_categoria_inmueble_departamento' ) ?>" class="chosen-select">
	    <option value="15"></option>
	  </select>
	</div>
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_inmueble_provincia_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_inmueble_provincia' ) ?>" class="right">Provincia:</label>
	</div>
	<div class="small-9 columns">
	  <select id="<?php prefix( 'sub_categoria_inmueble_provincia' ) ?>" class="chosen-select">
	    <option value="1"></option>
	  </select>
	</div>
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_inmueble_distrito_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_inmueble_distrito' ) ?>" class="right">Distrito:</label>
	</div>
	<div class="small-9 columns">
	  <select id="<?php prefix( 'sub_categoria_inmueble_distrito' ) ?>" class="chosen-select-deselect">
	    <option value="1"></option>
	  </select>
	</div>
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_inmueble_direccion_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_inmueble_direccion' ) ?>" class="right">Dirección:</label>
	</div>
	<div class="small-9 columns">
	  <textarea id="<?php prefix( 'sub_categoria_inmueble_direccion' ) ?>"></textarea>
	</div>      
      </div>
      <div class="row" id="<?php prefix( 'sub_categoria_inmueble_descripcion_content' ) ?>">
	<div class="small-3 columns">
	  <label for="<?php prefix( 'sub_categoria_inmueble_descripcion' ) ?>" class="right">Descripción:</label>
	</div>
	<div class="small-9 columns">
	  <textarea id="<?php prefix( 'sub_categoria_inmueble_descripcion' ) ?>"></textarea>
	</div>      
      </div>
      <div class="row">
	<div class="small-12 columns">
	  <button class="right button tiny info" id="<?php prefix( 'sub_categoria_inmueble_add' ) ?>">Añadir</button>
	  <button class="right button tiny secondary" id="<?php prefix( 'sub_categoria_inmueble_clear' ) ?>">Limpiar</button>
	</div>
      </div>
    </div>
    <div id="<?php prefix( 'sub_categoria_masivo_content' ) ?>"  class="<?php prefix( 'sub_categoria_content' ) ?> mazivos" style="display:none">
      <div class="row">
	<div class="small-4 columns">
	  <div class="row">
	    <div class="small-12 columns">
	      <input type="hidden" id="<?php prefix( 'categoria_masivo_id' ) ?>" value="0">
	      <textarea id="<?php prefix( 'categoria_masivo_descripcion' ) ?>"></textarea>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-12 columns aling-left">
	      <button id="<?php prefix( 'categoria_masivo_clear' ) ?>" class="button secondary tiny left" disabled>Cancelar</button>
	      <button id="<?php prefix( 'categoria_masivo_save' ) ?>" class="button tiny left" disabled>Añadir</button>
	    </div>
	  </div>
	</div>
	<div class="small-8 columns">
	  <div id="<?php prefix( 'categoria_masivo_label' ) ?>">
	    [Nuevo]
	  </div>
	  <div id="<?php prefix( 'categoria_masivo' ) ?>" class="ax-uploader"></div>
	</div>
      </div>

    </div>
  </div>
</div>
<div class="row">
  <div class="small-12 columns" id="<?php prefix( 'tabla' ) ?>">
  </div>
</div>
