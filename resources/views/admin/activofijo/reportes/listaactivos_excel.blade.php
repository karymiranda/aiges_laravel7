<table>
  <thead>
    <tr>
      <th>No</th> 
      <th>CLASIFICACIÓN DEL ACTIVO</th>
      <th>CÓDIGO</th>
      <th>DESCRIPCIÓN</th>
      <th>FECHA DE ADQUISICIÓN</th>      
      <th>VALOR</th>
      <th>VIDA ÚTIL (Años)</th>
      <th>NÚMERO DE SERIE</th>
      <th>MODELO</th>
      <th>MARCA</th>
      <th>MEDIDA</th>
      <th>MATERIAL DE CONSTRUCCIÓN</th>
      <th>CONDICIÓN</th>
      <th>UBICACIÓN</th>
      <th>OBSERVACIONES</th>
      <th>¿HA SIDO TRASLADADO?</th>
    </tr>
  </thead>
  <tbody>
  @foreach($activos as $key => $value)          
      <tr>            
      <td>{{$key+1}}</td>
      <td>{{$value->cuentacatalogo->v_nombrecuenta}}</td>
      <td>{{$value->v_codigoactivo}}</td>
      <td>{{$value->v_nombre}}</td>
      <td>{{$value->f_fecha_adquisicion}}</td>
      <td>{{$value->d_valor}}</td>
      <td>{{$value->v_vidautil}}</td>
      <td>{{$value->v_serie}}</td>
      <td>{{$value->v_modelo}}</td>
      <td>{{$value->v_marca}}</td>
      <td>{{$value->v_medida}}</td>
      <td>{{$value->v_materialdeconstruccion}}</td>
      <td>{{$value->v_condicionactivo}}</td>
      <td>{{$value->v_ubicacion}}</td>
      <td>{{$value->v_observaciones}}</td>
      @if($value->v_trasladoSN=='S')
      <td>SI</td>
      @else<td>NO</td>
      @endif
      </tr>
    @endforeach
  </tbody>
</table>