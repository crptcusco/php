<?php
include '../utilidades.php';

echo '<h1>Validar vacio a cero</h1>';
;
echo 'El valor: "' . ($in= ' ') . '" es "' . Utilitarios::validar_vacio_a_cero($in) . '"<br>'
;
echo 'El valor: "' . ($in= '012') . '" es "' . Utilitarios::validar_vacio_a_cero($in) . '"<br>'
;
