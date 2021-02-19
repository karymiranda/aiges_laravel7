 <table >
                <thead>
                  <tr>
                 
                  <th>EXPEDIENTE</th>
                  <th>NIE</th>
                  <th>APELLIDOS</th>
                  <th>NOMBRES</th>                  
                  <th>FECHA DE NACIMIENTO</th>
                  <th>GÉNERO</th>
                  <th>TELÉFONO</th>
                  <th>EMAIL</th>
                  <th>DIRECCIÓN</th>
              </tr>
                  </thead> 
              
                <tbody>
                 @foreach($nomina as  $estudiante)
                 <tr>                 
                 <td>{{ $estudiante->v_expediente }}</td>                 
                 @if($estudiante->v_nie!=null)
                 <td>{{ $estudiante->v_nie }}</td> 
                 @else
                  <td><span>-----</span></td> 
                 @endif
                 <td>{{$estudiante->v_apellidos }}</td>
                 <td>{{$estudiante->v_nombres }}</td>
                 <td>{{$estudiante->f_fnacimiento }}</td>
                 <td>{{$estudiante->v_genero }}</td>
                 @if($estudiante->v_telCelular!=null)
                 <td>{{$estudiante->v_telCelular }}</td>
                 @else
                  <td><span>-----</span></td> 
                 @endif
                  @if($estudiante->v_correo!=null)
                 <td>{{$estudiante->v_correo }}</td>
                 @else
                  <td><span>-----</span></td> 
                 @endif
                 <td>{{ $estudiante->v_direccion }}</td>
                </tr>         
                 @endforeach                            
              </tbody>
 </table>