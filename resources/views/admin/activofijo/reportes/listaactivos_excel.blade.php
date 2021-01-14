<table>
  <thead>
    <tr>
      <th>No</th> 
      <th>CLASIFICACION DEL ACTIVO</th>
      <th>CODIGO</th>
      <th>DESCRIPCION</th>
      <th>FECHA DE ADQUISICION</th>      
      <th>VALOR</th>
      <th>VIDA UTIL (Años)</th>
      <th>NUMERO DE SERIE</th>
      <th>MODELO</th>
      <th>MARCA</th>
      <th>MEDIDA</th>
      <th>MATERIAL DE CONSTRUCCION</th>
      <th>CONDICION</th>
      <th>UBICACION</th>
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