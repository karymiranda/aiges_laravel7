@extends('admin.menuprincipal')
<?php
if($modulo=='admin'){$titulo='Administración Académica/Estudiantes/ Ingreso Individual de Calificaciones';}

if($modulo=='docentes'){$titulo='Personal Docente / Ingreso Individual de Calificaciones';}
?> 
@section('tittle',$titulo)
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>INGRESO DE CALIFICACIONES</Strong></h3>
  </div>

{!! Form::open(['route'=>'addnotessingleadmin', 'method'=>'POST','class'=>'form-horizontal']) !!}
    <div class="box-body">
<input type="hidden" name="modulo" value="{{$modulo}}">
      <div class="form-group"> 
      {!! Form::label('', '', ['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
       <h3>{{$info}}</h3>
      </div>
      </div>

      <div class="form-group">
        {!! Form::label('periodo', 'Periodo', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">

          <select name="periodo" id="periodo" class="form-control" value>            
            @foreach ($periodos as $item)
              <option value="{{ $item->id }}">
                {{ $item->nombre }} [{{$item->descripcion}}]
              </option>
            @endforeach           
          </select>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('materia', 'Materia', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          {!! Form::select('materia', $asignaturas, null, ['class'=>'form-control','required'])!!}
        </div>
      </div>
      <!--div class="form-group">
        {!! Form::label('evaluacion', 'Evaluación', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          {!! Form::select('evaluacion', $evaluaciones, null, ['class'=>'form-control','required'])!!}
        </div>
      </div-->
    </div>
    <div class="box-footer" align="right">
      <input type="hidden" name="seccion_id" value="{{ $idseccion }}" />
      <input type="hidden" name="estudiante_id" value="{{ $id }}" />
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