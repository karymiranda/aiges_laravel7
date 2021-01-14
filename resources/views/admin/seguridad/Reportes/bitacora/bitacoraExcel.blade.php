<table>
  <thead>
    <tr>
      <th>FECHA</th> 
      <th>HORA</th>
      <th>USUARIO</th>
      <th>ACCIONES REALIZADAS</th>
    </tr>
  </thead>
  <tbody>
 @foreach($bitacora as $bitacora)          
      <tr>            
        <td>{{ $bitacora->created_at }}</td>
        <td></td>
        <td>{{ $bitacora->usuario_nombre }}</td>
        <?php $obj=json_decode($bitacora->operacion);
                  ?>                  
        <td><?php print $obj->{'operacion'} ?></td>
      </tr>
@endforeach
  </tbody>
</table>