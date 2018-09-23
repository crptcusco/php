<?php
/* original validateDate */
function validar_fecha($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
	// $d = date('d/m/Y', $date);
    return $d && $d->format($format) == $date;
}

function validar_fecha_mayor_igual($inicial,$final) {
    $datetime1 = new DateTime($inicial);
    $datetime2 = new DateTime($final);
    $interval = $datetime1->diff($datetime2);
    $diff =(int) $interval->format('%R%a');
    
    if ($diff>=0)
        return true;
    else
        return false;
}