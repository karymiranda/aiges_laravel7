 <table >
                <thead>
                  <tr>
                  <th>Código</th>
                  <th>IDSección</th>
                  <th>Fecha</th>
                  <th>NIE</th>
                  <th>Faltó</th>
                  <th>Justificación</th>
                  <th>Observación</th>
              </tr>
                  </thead> 
              
                <tbody>
                 @foreach($asistencias as $key => $asistencias)
                    <tr>
                      <td>{{ $asistencias->seccion }}</td>
                      <td>{{ $asistencias->codigo }}</td>
                      <td>{{ $asistencias->f_fecha }}</td>
                      <td>{{ $asistencias->v_nie }}</td>
                       @if($asistencias->v_asistenciaSN=='S')
                       <td>Si</td> 
                       @else
                        <td>No</td> 
                       @endif
                     <td>{{ $asistencias->justificacion }}</td>
                     <td>{{ $asistencias->observacion }}</td>
                   </tr>         
                 @endforeach                            
              </tbody>
 </table>