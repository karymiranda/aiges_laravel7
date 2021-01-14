@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/ Competencias Ciudadanas';}

if($modulo=='docentes'){$titulo='Personal Docente / Mis Secciones / Competencias Ciudadanas';}
?> 
@section('tittle',$titulo)
@section('content')
<div class="box box-primary box-solid" style="overflow: auto;">
  <div class="box-header">
    <h2 class="box-title"> EDITAR  COMPETENCIA </h2>
    <label class="text-white"></label>
  </div>
  <form action="{{route('UpdateCompetenciasingleadmin')}}" method="POST">
    {{ csrf_field() }}


    <div class="box-body">

<div class="col-xs-6 col-sm-offset-3">
<table class="table table-bordered table-striped">
          <thead>
            <th>Criterio</th>
            <th>Descripción</th>
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
        <table class="table table-bordered table-striped" id="">
          <thead>
          <th class="text-center">ID</th>
          <th class="text-center">NIE</th>
          <th class="text-center">Nombre del alumno</th>
           <th class="text-center">Periodo evaluado</th>
            <th width='100'>Criterio 1</th>
            <th width='100'>Criterio 2</th>
            <th width='100'>Criterio 3</th>
            <th width='100'>Criterio 4</th>
            <th width='100'>Criterio 5</th>
          </thead>
          <tbody>
           <tr>

              @foreach($competencia as $key => $row)
            <tr>

     <input type="hidden" name="modulo" value="{{$modulo}}">
     <input type="hidden" name="id" value="{{ $row->id}}">
     <input type="hidden" name="idestudiante" value="{{ $idestudiante}}">
      <input type="hidden" name="idperiodo" value="{{ $idperiodo}}">
    
              <td>{{$key + 1}}</td>
              <td>{{$row->v_nie}}</td>
              <td>{{$row->v_apellidos}} {{ $row->v_nombres }}</td>
               <td class="text-center">{{$row->descripcion}}</td>
              <td class="text-center">

              	 {!! Form::select('cr1',['B'=>'B','MB'=>'MB','E'=>'E'],$row->criterio_1,['class'=>'form-control'])!!}

              	</td>
              <td class="text-center"> {!! Form::select('cr2',['B'=>'B','MB'=>'MB','E'=>'E'],$row->criterio_2,['class'=>'form-control'])!!}
              </td>
              <td class="text-center">{!! Form::select('cr3',['B'=>'B','MB'=>'MB','E'=>'E'],$row->criterio_3,['class'=>'form-control'])!!} </td>
              <td class="text-center">{!! Form::select('cr4',['B'=>'B','MB'=>'MB','E'=>'E'],$row->criterio_4,['class'=>'form-control'])!!}</td>
              <td class="text-center">{!! Form::select('cr5',['B'=>'B','MB'=>'MB','E'=>'E'],$row->criterio_5,['class'=>'form-control'])!!}</td>
             
            </tr>
          @endforeach
              </tr>
          </tbody>
        </table>
      </div> 

    </div>

    <div class="box-footer" align="right">   

      <input class="btn btn-primary" type="submit" value="Actualizar">
    </div>

  </form>

</div>

@endsection