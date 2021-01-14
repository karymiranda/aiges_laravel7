 <table >
                <thead>
                  <tr>
                 
                  <th>EXPEDIENTE</th>
                  <th>NIE</th>
                  <th>ESTUDIANTE</th>
                  <th>FECHA DE NACIMIENTO</th>
                  <th>NOMBRE DEL RESPONSABLE</th>
                  <th>PARENTESCO</th>
                  <th>TELEFONO DEL RESPONSABLE</th> 
              </tr>
                  </thead> 
              
                <tbody>
                 @foreach($listaestudiantes as $key => $estudiante)
                  @foreach($estudiante->estudiante_familiares as $familiar)
                 <tr>
                 
                 <td>{{ $estudiante->v_expediente }}</td>                 
                 @if($estudiante->v_nie!=null)
                 <td>{{ $estudiante->v_nie }}</td> 
                 @else
                  <td><span>-----</span></td> 
                 @endif
                 <td>{{  $estudiante->v_apellidos }}, {{$estudiante->v_nombres }}</td>
                 <td>{{ $estudiante->f_fnacimiento }}</td> 
                 <td>{{ $familiar->nombres}} {{ $familiar->apellidos}}</td> 
                 <td>{{$familiar->pivot->parentesco}}</td>
                 @if($familiar->celular!=null)
                 <td>{{ $familiar->celular}}</td> 
                 @else
                  <td><span>-----</span></td> 
                 @endif
                </tr>
                 @endforeach               
                 @endforeach                            
              </tbody>
 </table>