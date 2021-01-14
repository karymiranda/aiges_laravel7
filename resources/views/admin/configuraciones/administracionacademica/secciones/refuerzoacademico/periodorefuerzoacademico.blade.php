@extends('admin.menuprincipal')
<?php 
if ($modulo=='admin') 
  {$var = 'Configuraciones/Administración Académica/Secciones/Refuerzo Académico';}
else
{$var='Docente/Refuerzo Académico';}
?>
@section('tittle', $var)

@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>REFUERZO ACADEMICO</Strong></h3>
  </div>

  {!! Form::open(['route'=>'refuerzonotas', 'method'=>'POST','class'=>'form-horizontal']) !!}
  <input type="hidden" name="modulo" value="{{$modulo}}">
    <div class="box-body">
      <div class="form-group">
        {!! Form::label('periodo', 'Año lectivo', ['class'=>'col-sm-5 control-label']) !!}
        <div class="col-sm-3">
          {!! Form::select('periodoactivo_id',$aniolectivoactivo, null, ['class'=>'form-control','required','readonly'])!!}
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('seccion', 'Sección', ['class'=>'col-sm-5 control-label']) !!}
        <div class="col-sm-3">
          {!! Form::select('seccion_id',$seccion, null, ['class'=>'form-control','required','readonly'])!!}
        </div>
      </div>
<div class="form-group">
        {!! Form::label('periodo', 'Periodo', ['class'=>'col-sm-5 control-label']) !!}
        <div class="col-sm-3">
          <select name="periodo" id="periodo" class="form-control" value>            
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
      {!! Form::submit('Siguiente', ['class'=>'btn btn-primary']) !!}
     @if($modulo=='admin')
      <a href="{{route('listasecciones')}}" class="btn btn-default">Cancelar</a>
     @endif
     @if($modulo=='docente')
      <a href="{{route('nominadeestudiantes',$id)}}" class="btn btn-default">Cancelar</a>
     @endif

    </div>
  {!! Form::close() !!}
  @endsection