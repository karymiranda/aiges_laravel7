<table >
                <thead>
                  <tr>
                  <th>No</th>
                  <th>DUI</th>
                  <th>NOMBRE DEL FAMILIAR</th>
                  <th>PARENTESCO</th>
                  <th>TELEFONO CASA</th>
                  <th>CELULAR</th>
                  <th>NOMBRE DEL ESTUDIANTE</th> 
              </tr>
                  </thead> 
              
                <tbody>
                 @foreach($listafamiliares as $key =>  $estudiante)
                  @foreach($estudiante->estudiante_familiares as $familiar)
                 <tr>
                 <td>{{$key+1}}</td>                
                 @if($familiar->dui!=null)
                <td>{{ $familiar->dui}}</td>   
                 @else
                  <td><span>----</span></td> 
                 @endif
                  <td>{{ $familiar->nombres}} {{ $familiar->apellidos}}</td> 
                 <td>{{ $familiar->parentesco->parentesco}}</td>
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
                 <td>{{  $estudiante->v_apellidos }}, {{$estudiante->v_nombres }}</td>
                </tr>
                 @endforeach               
                 @endforeach                            
              </tbody>
 </table>