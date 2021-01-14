@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/ Competencias Ciudadanas';}

if($modulo=='docentes'){$titulo='Personal Docente / Mis Secciones / Competencias Ciudadanas';}
?> 
@section('tittle',$titulo)
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header">
    <h2 class="box-title"><Strong>COMPETENCIAS CIUDADANAS</Strong></h2>
  </div>

 {!! Form::open(['route'=>'addcompetenciassingleadmin', 'method'=>'POST','class'=>'form-horizontal']) !!}
 
    <div class="box-body">
<div class="form-group"> 
      {!! Form::label('', '', ['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
       <h3>{{$info}}</h3>
      </div>
      </div>
 
      <div class="form-group">
        {!! Form::label('periodo', 'Periodo', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          <select name="periodo" id="periodo" class="form-control" title="Muestra solamente el periodo de evaluación activo" value>
            @foreach ($periodos as $item)
              <option value="{{ $item->id }}">
                {{ $item->nombre }} [{{$item->descripcion}}]
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="box-footer" align="right">      
      <input type="hidden" name="modulo" value="{{$modulo}}">
      <input type="hidden" name="estudiante_id" value="{{ $id }}" />
      <input type="hidden" name="seccion_id" value="{{ $idseccion }}" />
      {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
      

<?php
if($modulo=='admin'){?>
  <a href="{{route('listaexpedientes')}}" class="btn btn-default">Cancelar</a>
    <?php } ?>

<?php
if($modulo=='docentes'){?>
  <a href="{{route('nominadeestudiantes',$idseccion)}}" class="btn btn-default">Cancelar</a>
<?php } ?> 

    </div>
  {!! Form::close() !!}
  @endsection