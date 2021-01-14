 <table >
                <thead>
                  <tr>
                  <th>Nie</th>
                  <th>Calificación</th>
                  <th>Fecha</th>
                  <th>Observacion</th>                                 
                  <th>Nombre de estudiante</th>
                  <th>Asignatura</th> 
                  <th>Periodo</th>   
                  <th>Sección</th>
              </tr>
                  </thead> 
              
                <tbody>
                 @foreach($students as $key => $students)
<?php
$promp1=(isset($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['ACT1']) ? number_format(($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['ACT1']),2) : 0) +
      (isset($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['ACT2']) ? number_format(($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['ACT2']),2) : 0) +
      (isset($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['ACT3']) ? number_format(($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['ACT3']),2) : 0) +
      (isset($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['RF']) ? number_format(($notas[$students->v_expediente][$asignatura->asignatura][$periodo->nombre]['RF']),0) : 0);
 ?>
                    <tr>
                      <td>{{ $students->v_expediente}}</td>
                      <td>{{number_format($promp1,0)}}</td>
                <td>{{$hoy}}</td>
                <td></td>
                <td>{{ $students->v_apellidos}} {{ $students->v_nombres}} </td>
                      <td>{{ $asignatura->descripcion}}</td>
                      <td>{{ $periodo->nombre}}</td>
                      <td>{{ $seccion->descripcion}}</td>
                      
                   </tr> 
                         
                 @endforeach                            
              </tbody>
 </table>


