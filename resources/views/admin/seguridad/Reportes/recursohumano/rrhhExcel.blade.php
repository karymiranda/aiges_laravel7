<table>
  <thead>
    <tr>
      <th>EXPEDIENTE</th> 
      <th>NOMBRE COMPLETO</th>
      <th>DIRECCION</th>
      <th>DUI</th>
      <th>CARGO</th>
      <th>CELULAR</th>
    </tr>
  </thead>
  <tbody>
    @foreach($empleados as $empleado)          
      <tr>            
        <td>{{ $empleado->v_numeroexp }}</td>
        <td>{{ $empleado->v_nombres . ' ' . $empleado->v_apellidos }}</td>
        <td>{{ $empleado->v_direccioncasa }}</td>
        <td>{{ $empleado->v_dui }}</td>
        <td>{{ $empleado->cargo->v_descripcion }}</td>
        <td>{{ $empleado->v_celular }}</td>
      </tr>
    @endforeach
  </tbody>
</table>