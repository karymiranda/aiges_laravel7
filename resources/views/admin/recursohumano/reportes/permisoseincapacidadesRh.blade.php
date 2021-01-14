<table>
  <thead>
    <tr>
      <th>NIP</th> 
      <th>NOMBRE COMPLETO</th>
      <th>TIPO CONTRATO</th>
      <th>DESDE</th>
      <th>HASTA</th>
      <th>DIAS</th>
      <th>HORAS</th>
      <th>MINUTOS</th>
      <th>DIAS SIN JUSTIFICACION</th>
      <th>TIPO PERMISO</th>
      <th>OBSERVACIONES</th>
    </tr>
  </thead>
  <tbody>
    @foreach($permisos as $value)          
      <tr>            
        <td>{{ $value->empleado->v_nip }}</td>
        <td>{{ $value->empleado->v_nombres . ' ' . $value->empleado->v_apellidos }}</td>
        <td>{{ $value->empleado->v_tipocontratacion }}</td>
        <td>{{ $value->f_desde }}</td>
        <td>{{ $value->f_hasta }}</td>
        <td>{{ $value->i_tiemposolicitado }}</td>
        <td>{{ $value->i_horas }}</td>
        <td>{{ $value->i_minutos }}</td>
        <td></td>
        <td>{{ $value->motivoPermiso->v_motivo }}</td>
        <td>{{ $value->v_observaciones }}</td>
      </tr>
    @endforeach
  </tbody>
</table>