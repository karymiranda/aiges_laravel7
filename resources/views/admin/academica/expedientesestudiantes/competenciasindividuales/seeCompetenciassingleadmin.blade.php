@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/ Competencias Ciudadanas';}

if($modulo=='docentes'){$titulo='Personal Docente / Mis Secciones / Competencias Ciudadanas';}
?> 
@section('tittle',$titulo)
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
      <h2 class="box-title"><strong>COMPETENCIAS CIUDADANAS</strong></h2>
    </div>
  <div class="box-body">

  	<div class="col-xs-6 col-sm-offset-3">
<table class="table table-bordered table-striped">
          <thead>
            <th class="text-center">Criterio</th>
            <th class="text-center">Descripción</th>
          </thead>
          <tbody>
             @foreach($comp as $key => $comp)
            <tr>
                <td>Criterio {{$key + 1}}</td>
                <td>{{$comp->competencia}}</td>
            </tr>
           @endforeach
          </tbody>
</table>
</div>

    <div class="col-xs-12">
      <table class="table table-bordered table-striped" id="tablaAsistencia">
        <thead>
          <th class="text-center">ID</th>
          <th class="text-center">NIE</th>
          <th class="text-center">Nombre del alumno</th>
           <th class="text-center">Periodo evaluado</th>
          <th width='100' class="text-center" >Criterio 1</th>
          <th width='100' class="text-center">Criterio 2</th>
          <th width='100' class="text-center">Criterio 3</th>
          <th width='100' class="text-center">Criterio 4</th>
          <th width='100' class="text-center">Criterio 5</th>
           <th width='100' class="text-center">Acciones</th>
        </thead>
        <tbody>
          @foreach($competencia as $key => $row)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$row->v_nie}}</td>
              <td>{{$row->v_apellidos}} {{ $row->v_nombres }}</td>
              <td class="text-center">{{$row->descripcion}}</td>
              <td class="text-center">{{$row->criterio_1}}</td>
              <td class="text-center">{{$row->criterio_2}}</td>
              <td class="text-center">{{$row->criterio_3}}</td>
              <td class="text-center">{{$row->criterio_4}}</td>
              <td class="text-center">{{$row->criterio_5}}</td>
              <td class="text-center">
               <a href="{{ route('Editcompsingleadmin',[$id,$periodo,$modulo]) }}"  title="Ver" class="btn btn-primary">Editar</a>
               </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>  
  </div>
   <div class="box-footer" align="right">
  <a href="{{route('listcompsingleadmin',[$id,$modulo])}}" class="btn btn-default">Regresar</a>
 

</div>
</div>
@endsection

