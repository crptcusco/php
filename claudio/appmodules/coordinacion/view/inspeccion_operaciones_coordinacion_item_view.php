<?php
class Inspeccion_Operaciones_Coordinacion_Item_View {
    function imprimir($in) {
        // fecha
        /* $f = Utilidades::fechas_de_MysqlTimeStamp_a_array($in['fecha']); */
        /* $in['fecha'] =  $f['dia'] . '-' . $f['mes'] . '-' . $f['anio']; */
        /* if ($in['fecha'] == '00-00-0000') { */
        /*     $in['fecha'] = ''; */
        /* } */
        
        // hora aproximada
        $h = explode("-", $in['hora_estimada']);
        $h1 = explode(":",$h[0]);
        $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
        $h2 = explode(":",$h[1]);
        $h2 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h2[0], 'minuto'=>(int)$h2[1], 'return'=>'array'));
        $in['hora_estimada_str'] = sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
        $in['hora_estimada_str'].= ' - ';
        $in['hora_estimada_str'].= sprintf("%02d:%02d %s" , $h2['hora'] , $h2['minuto'], $h2['meridiano']);
        if ($in['hora_estimada_mostrar']=='0') {
            $in['hora_estimada_str']='';
        } else {
            $in['hora_estimada_str'] = '<strong>Estimado</strong><br>' . $in['hora_estimada_str'];
        }
        $in['hora_estimada_ini'] = $h1;
        $in['hora_estimada_end'] = $h2;
        // hora exacta
        $h1 = explode(":", $in['hora_real']);
        $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
        $in['hora_real'] = $h1;
        $in['hora_real_str'] = sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
        if ($in['hora_real_mostrar'] == '0') {
            $in['hora_real_str'] = '';
        } else {
            $in['hora_real_str'] = '<strong>Real</strong><br>' . $in['hora_real_str'];
        }
        // ubigeo
        $in['ubigeo'] = utf8_encode($in['departamento_nombre']);
        if ($in['departamento_id']!=0) {
            $in['ubigeo'].= ' <span style="color:red">&#9658;</span> ';
        }
        $in['ubigeo'].= utf8_encode($in['provincia_nombre']);
        if ($in['provincia_id']!=0) {
            $in['ubigeo'].= ' <span style="color:red">&#9658;</span> ';
        }
        $in['ubigeo'].= utf8_encode($in['distrito_nombre']);
        return '
<thead>
  <tr>
    <th class="text-center" width="130"></th>
    <th class="text-center" width="130">Contacto</th>
    <th class="text-center" width="90">Fecha</th>
    <th width="150">Hora</th>
    <th>Direccion</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="text-center"
        perito_id="' . $in['perito_id'] . '"
        inspector_id="' . $in['inspector_id'] . '"
        >
    </td>
    <td>' . utf8_encode($in['contactos']) . '</td>
    <td class="text-center">' . $in['fecha'] . '</td>
    <td est_ini_ho="' . sprintf('%02d', $in['hora_estimada_ini']['hora']) . '"
        est_ini_mi="' . sprintf('%02d', $in['hora_estimada_ini']['minuto']) . '"
        est_ini_me="' . $in['hora_estimada_ini']['meridiano'] . '"
        est_end_ho="' . sprintf('%02d', $in['hora_estimada_end']['hora']) . '"
        est_end_mi="' . sprintf('%02d', $in['hora_estimada_end']['minuto']) . '"
        est_end_me="' . $in['hora_estimada_end']['meridiano'] . '"
        est_mostrar="' . $in['hora_estimada_mostrar'] . '"
        rea_ho="' . sprintf('%02d', $in['hora_real']['hora']) . '"
        rea_mi="' . sprintf('%02d', $in['hora_real']['minuto']) . '"
        rea_me="' . $in['hora_real']['meridiano'] . '"
        rea_mostrar="' . $in['hora_real_mostrar'] . '"
        class="text-center"
        >
      ' . $in['hora_estimada_str'] . '
      ' . $in['hora_real_str'] . '
    </td>
    <td departamento_id="' . $in['departamento_id'] . '"
        provincia_id="' . $in['provincia_id'] . '"
        distrito_id="' . $in['distrito_id'] . '"
        >
      ' . $in['ubigeo'] . '
      <hr style="margin:.4em 0">
      <span class="datos">' . utf8_encode($in['direccion']) . '</span>
    </td>
  </tr>
  <tr>
    <th>Perito</th>
    <td colspan="5">' . utf8_encode($in['perito_nombre']) . '</td>
  </tr>
  <tr>
    <th>Control de Calidad</th>
    <td colspan="5">' . utf8_encode($in['inspector_nombre']) . '</td>
  </tr>
  <tr>
    <td colspan="6"> <strong>Observación: </strong><span class="observacion">' . utf8_encode($in['observacion']) . '</span></td>
  </tr>
</tbody>
              ';
    }
}
