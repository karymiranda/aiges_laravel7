@extends('admin.menuprincipal')
@section('tittle', 'Personal Docente/Asistencia Estudiantes')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header">
    <h2 class="box-title"><Strong>ASISTENCIA </Strong></h2>
  </div>

  {!! Form::open(['route'=>'marcarasistencialistaestudiantes_view', 'method'=>'POST','class'=>'form-horizontal']) !!}
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
          {!! Form::select('seccion_id',$seccion, null, ['class'=>'form-control','required'])!!}
        </div>
      </div>

         <div class="form-group">                                           
      {!! Form::label('lblfec', 'Fecha',['class'=>'col-sm-5 control-label']) !!}
                              <div class="col-sm-3">

                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="{{$fecha}}" name="fecha" id="fecha"  class="form-control pull-right nac" data-mask required="true" class="form-control pull-right" required="true">
                                </div>
                                </div>
               
 </div>

    </div>
    <div class="box-footer" align="right">
      {!! Form::submit('Siguiente', ['class'=>'btn btn-primary']) !!}
      <a href="{{route('listaasistencias')}}" class="btn btn-default">Cancelar</a>
    </div>
  {!! Form::close() !!}
  @endsection