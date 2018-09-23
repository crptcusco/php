<?php

function mes($num) {
  $mes = "";
  switch ($num) {
    case "01":
      $mes = "Enero";
      break;
    case "02":
      $mes = "Febrero";
      break;
    case "03":
      $mes = "Marzo";
      break;
    case "04":
      $mes = "Abril";
      break;
    case "05":
      $mes = "Mayo";
      break;
    case "06":
      $mes = "Junio";
      break;
    case "07":
      $mes = "Julio";
      break;
    case "08":
      $mes = "Agosto";
      break;
    case "09":
      $mes = "Setiembre";
      break;
    case "10":
      $mes = "Octubre";
      break;
    case "11":
      $mes = "Noviembre";
      break;
    case "12":
      $mes = "Diciembre";
      break;
  }
  return $mes;
}

function fechaMysql($fecha) {

  $dia = substr($fecha, 0, 2);
  $mes = substr($fecha, 3, 2);
  $anio = substr($fecha, -4);
  return $anio . "-" . $mes . "-" . $dia;
}

function horaMysql($fecha) {
  $hor = substr($fecha, 0, 2);
  $minuto = substr($fecha, 3, 2);
  $ampm = substr($fecha, 6, 2);
  if ($ampm == 'PM') {
    $hora = ($hor < 12) ? $hor + 12 : $hor;
  } else {
    $hora = $hor;
  }
  return $hora . ':' . $minuto . ':00';
}

function fechaPhp($fecha) {
  if ($fecha != "") {
    $dia = substr($fecha, 8, 2);
    $mes = substr($fecha, 5, 2);
    $anio = substr($fecha, 0, 4);
    $ext = "";
    if (strlen($fecha) >= 19) {
      $hora = substr($fecha, 11, 2);
      $min = substr($fecha, 14, 2);
      $tex = 'am';
      if (!($hora > 9)) {
        $hora = substr($hora, 1, 1);
      }
      if ($hora > 12) {
        $hora = $hora - 12;
        $tex = 'pm';
      }
      $ext = " a las $hora:$min$tex";
    }
    return $dia . "/" . $mes . "/" . $anio . $ext;
  }
}

function horaPhp($fecha) {
  if ($fecha != "") {
    $fecha = "15:15:00";
    $hor = substr($fecha, 0, 2);
    $minuto = substr($fecha, 3, 2);
    if ($hor >= 12) {
      $hora = ($hor > 12) ? $hor - 12 : $hor;
      $hora = ($hora > 9) ? $hora : '0' . $hora;
      $ampm = 'PM';
    } else {
      $hora = ($hor > 9) ? $hor : '0' . $hor;
      $ampm = 'AM';
    }
    return $hora . ':' . $minuto . ' ' . $ampm;
  }
}

function fechaCompleta($fecha) {
  if ($fecha != "") {
    $dia = substr($fecha, 8, 2);
    $mes = substr($fecha, 5, 2);
    $anio = substr($fecha, 0, 4);
    return $dia . " de " . mes($mes) . " del " . $anio;
  }
}

function fechaCompletaFull($fecha) {
  if ($fecha != "") {
    $dia = substr($fecha, 8, 2);
    $mes = substr($fecha, 5, 2);
    $anio = substr($fecha, 0, 4);
    $ext = "";
    if (strlen($fecha) >= 19) {
      $hora = substr($fecha, 11, 2);
      $min = substr($fecha, 14, 2);
      $tex = 'am';
      if (!($hora > 9)) {
        $hora = substr($hora, 1, 1);
      }
      if ($hora > 12) {
        $hora = $hora - 12;
        $tex = 'pm';
      }
      $ext = " a las $hora:$min$tex";
    }
    return $dia . " de " . mes($mes) . " del " . $anio . $ext;
  }
}

function restaFecha($fecha1, $fecha2) {
  $f1 = strtotime($fecha1);
  $f2 = strtotime($fecha2);
  $diff = $f2 - $f1;
  return round($diff / 86400);
}

?>
