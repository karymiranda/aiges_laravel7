<table>
  <thead>
    <tr> 
      <th>FECHA DE PRESTAMO</th>
      <th>CODIGO DE ACTIVO</th>
      <th>DESCRIPCION</th>
      <th>TIPO DE TRASLADO</th>      
      <th>DESTINO</th>
      <th>ENVIADO POR</th>
      <th>RECIBIDO POR</th>
    </tr>
  </thead>
  <tbody>
   @foreach($traslados as $key => $value)          
      <tr>            
      <td>{{$value->f_fechatraslado}}</td>
      <td>{{$value->activofijo->v_codigoactivo}}</td>
      <td>{{$value->activofijo->v_nombre}}</td>
      <td>{{$value->tipotraslado->v_descripcion}}</td>
      <td>{{$value->destino->nombre_institucion}}</td>
      <td>{{$value->v_personaautoriza}}</td>
      <td>{{$value->v_personarecibe}}</td>
      </tr>
    @endforeach
  </tbody>
</table>