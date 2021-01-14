@extends('admin.menuprincipal')
<?php 
if ($modulo=='admin') 
  {$var = 'Administración Académica/Alumnos/Refuerzo Académico';}
else
{$var='Docente/Refuerzo Académico';}
?>
@section('tittle', $var)
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
   <div class="box-header">
        <h2 class="box-title"><strong>CALIFICACIONES</strong></h2>      
    </div>
  <form action="{{route('refuerzonotas')}}" method="post" >
    {{ csrf_field() }}
    <input type="hidden" name="periodo" value="{{ $periodoevaluado->id }}" />
    <input type="hidden" name="seccion_id" value="{{ $seccion }}" />
    <input type="hidden" name="modulo" value="{{ $modulo }}" />
    <div class="box-body">
      <div class="col-sm-6 col-sm-offset-3">
        <table class="table table-bordered table-striped">
          <thead>
            <th>NIE</th>
            <th>ALUMNO/@</th>
            <th>ASIGNATURA</th>
             <th>PERIODO</th>
          </thead>
       <tbody>     
        <td>{{$alumno->v_nie}}</td>	
       <td>{{$alumno->v_apellidos}},  {{$alumno->v_nombres}}</td>	
        <td>{{$asignatura->asignatura}}</td>
         <td>{{$periodoevaluado->descripcion}}</td>		
       </tbody>
        </table>
      </div>  

 <div class="col-sm-6 col-sm-offset-3">
        <table class="table table-bordered table-striped" >
          <thead align="center">
            <th style="background-color: #49a6dc; color: white" >EVALUACION</th>
            <th style="background-color: #49a6dc; color: white" >CALIFICACION</th> 
             <th style="background-color: #49a6dc; color: white" >PONDERACION</th>      
          </thead>
          <tbody> 
         <?php $prom=0; ?>          	
 @foreach($notaArray as $eval)
  @foreach($eval->notas as $row)
 <tr>
 	 <td>{{$eval->evaluacion->nombre}}</td>
 	 <td align="center">{{$row->calificacion}}</td>   
   <td align="center">{{$row->calificacion*$eval->evaluacion->d_porcentajeActividad/100}}</td>
   <?php
   $prom+=$row->calificacion*$eval->evaluacion->d_porcentajeActividad/100; 
  /*if($eval->evaluacion->codigo_eval!='RF')
    {
      $prom+=$row->calificacion/3; 
      $prom=number_format($prom,2);
    }
    else{  $prom=$prom+$row->calificacion;  }*/
      ?> 
 </tr>
              @endforeach()
 		   @endforeach()

  <tr>
  <td style="background-color: #49a6dc; color: white" colspan="2">PROMEDIO: </td>
  <td align="center" style="background-color: #49a6dc; color: white"><strong>{{ number_format($prom,2) }}</strong></td>
  </tr>
          </tbody>
        </table>
      </div>  


    </div>
    <div class="box-footer" align="right">                
      <input type="submit" name="" value="Regresar"/>
    </div>
  </form>
</div>
@endsection