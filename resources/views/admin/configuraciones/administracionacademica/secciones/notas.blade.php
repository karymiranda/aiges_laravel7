@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Secciones/Calificaciones')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>CALIFICACIONES</Strong></h3>
  </div>

  {!! 
    Form::open([
      'url' => '/seccionnotas','id'=>'formu', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
      @csrf
    <div class="box-body">
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
      <div class="form-group">
        {!! Form::label('evaluacion', 'Evaluación', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          {!! Form::select('evaluacion', $evaluaciones, null, ['class'=>'form-control','required'])!!}
        </div>
      </div>

        <div class="form-group">
        {!! Form::label('', '', ['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4"m align="right">
       
             </div>
      </div>


 

    </div>
    <div class="box-footer" align="right">
      <input type="hidden" name="seccion_id" value="{{ $id }}" />
      {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
      <a href="{{route('listasecciones')}}" class="btn btn-default">Cancelar</a>
    </div>
  {!! Form::close() !!}
  @endsection



