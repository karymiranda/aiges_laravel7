<table>
  <thead>
    <tr> 
      <th>CODIGO</th>
      <th>CUENTA</th>
      <th>NIVEL</th>      
      <th>TIPO SALDO</th>
  
    </tr>
  </thead>
  <tbody>
  @foreach($activos as $key => $value)          
      <tr>     
      <td>{{$value->v_codigocuenta}}</td>
      <td>{{$value->v_nombrecuenta}}</td>
      <td>{{$value->v_nivel}}</td>
      <td>{{$value->clasificacioncuentacatalogo->v_tipocuenta}}</td>
      <td>{{$value->v_tiposaldo}}</td>
      </tr>
    @endforeach
  </tbody>
</table>