@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/Calificaciones';}

if($modulo=='docentes'){$titulo='Personal Docente / Ingreso Individual de Calificaciones';}
?> 
@section('tittle',$titulo)
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
   <div class="box-header">
        <h2 class="box-title"><strong>AGREGAR CALIFICACIONES</strong></h2>      
    </div>
  <form action="{{route('savenotessingleadmin')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="periodo" value="{{ $params['periodo'] }}" />
    <input type="hidden" name="materia" value="{{ $params['materia'] }}" />

    <input type="hidden" name="seccion_id" value="{{ $params['seccion_id'] }}" />
      <input type="hidden" name="estudiante_id" value="{{ $params['estudiante_id'] }}" />

    <input type="hidden" name="modulo" value="{{$modulo}}" /> 
   
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
        <td>{{$estudiante->v_nie}}</td>	
       <td>{{$estudiante->v_apellidos}} {{$estudiante->v_nombres}}</td>	
        <td>{{$asignatura->asignatura}}</td>
         <td>{{$periodo->descripcion}}</td>		
       </tbody>
        </table>
      </div>  

 <div class="col-sm-6 col-sm-offset-3">
        <table class="table table-bordered table-striped" >
          <thead>
            <th>EVALUACION</th>
            <th>CALIFICACION</th>           
          </thead>
          <tbody>
            @foreach($evaluaciones as $eval)
           <tr>
 <td>{{$eval->nombre}}</td>
    <input type="hidden" name="nota_id[]" value="{{$eval->id}}" />
<td><input required step="any" max="10" min="0"
                    type="number" name="notas[]" id="nota[]" class="form-control" /></td>
           </tr>
 		   @endforeach()
          </tbody>
        </table>
      </div>  


    </div>
    <div class="box-footer" align="right">                
      <input class="btn btn-primary" type="submit" value="Guardar">
      <a href="{{route('listnotessingleadmin',[$estudiante->id,$modulo])}}" class="btn btn-default">Cancelar</a>
    </div>
  </form>
</div>
@endsection