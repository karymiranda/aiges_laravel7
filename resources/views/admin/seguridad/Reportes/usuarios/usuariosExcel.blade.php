<table>
    <thead>
        <tr>         
          <th>NOMBRE DE USUARIO</th>
          <th>CUENTA</th>
          <th>ROLES</th>
        </tr>
    </thead>
    <tbody>  
        @foreach($usuarios as $usuario)       
          <tr>
            <?php if ($usuario->empleado!=null): ?>
              <td>{{$usuario->empleado->v_nombres .' '. $usuario->empleado->v_apellidos}}</td>
            <?php else: ?>
              <?php if ($usuario->estudiante!=null): ?>
              <td>{{$usuario->estudiante->v_nombres .' '. $usuario->estudiante->v_apellidos}}</td>
              <?php else: ?>
                <td>{{$usuario->familiar->nombres .' '. $usuario->familiar->apellidos}}</td>
              <?php endif ?>
            <?php endif ?>                        
            <td>{{$usuario->name}}</td>
            <td>
              @foreach($usuario->usuario_rol as $rol)
                {{$rol->v_nombrerol}}<br>
              @endforeach
            </td>          
          </tr> 
        @endforeach        
    </tbody>
</table>