<table >
                <thead>
                  <tr>
                  <th>DUI</th>
                  <th>APELLIDOS</th>
                  <th>NOMBRES</th>
                  <th>GÉNERO</th>
                  <th>FECHA DE NACIMIENTO</th>                  
                  <th>DIRECCION</th>
                  <th>TELÉFONO CASA</th>
                  <th>TELÉFONO  PERSONAL</th>
                  <th>CORREO</th>
                  <th>NIVEL EDUCATIVO</th>
                  <th>PROFESIÓN</th>
                  <th>ESTUDIANTE</th>
                  <th>PARENTESCO</th>
                  <th>¿ENCARGADO?</th>
                  <th>¿PUEDE RETIRAR AL ESTUDIANTE?</th>
              </tr>
                  </thead> 
              
                <tbody> 
                 @foreach($listafamiliares as $key =>  $estudiante)
                  @foreach($estudiante->estudiante_familiares as $familiar)
                 <tr>                
                 @if($familiar->dui!=null)
                <td>{{ $familiar->dui}}</td>   
                 @else
                  <td><span>----</span></td> 
                 @endif
                 <td>{{ $familiar->apellidos}}</td> 
                 <td>{{ $familiar->nombres}}</td>  
				 <td>{{ $familiar->genero}}</td> 
				 <td>{{ $familiar->fechanacimiento}}</td>
				 <td>{{ $familiar->direccionderesidencia}}</td>   
                
                 @if($familiar->telefonocasa!=null)
                 <td>{{ $familiar->telefonocasa}}</td> 
                 @else
                  <td><span>-----</span></td> 
                 @endif
                  @if($familiar->celular!=null)
                 <td>{{ $familiar->celular}}</td> 
                 @else
                  <td><span>-----</span></td> 
                 @endif
                  @if($familiar->correo!=null)
                 <td>{{ $familiar->correo}}</td> 
                 @else
                  <td><span>-----</span></td> 
                 @endif
 				  <td>{{ $familiar->niveleducativo}}</td> 
 				  <td>{{ $familiar->profesion}}</td>  
          <td> {{ $estudiante->v_apellidos}} {{ $estudiante->v_nombres}}</td>
          <td>{{ $familiar->pivot->parentesco}}</td>
          <td>{{$familiar->pivot->encargado}}</td>
          <td>{{ $familiar->pivot->autorizacion}}</td>           
                 
                </tr>
                 @endforeach               
                 @endforeach                            
              </tbody>
 </table>