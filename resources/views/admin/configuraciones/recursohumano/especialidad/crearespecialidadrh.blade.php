@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Recurso Humano/Especialidades')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>AGREGAR ESPECIALIDAD</Strong></h3>
  </div>
  <!-- /.box-header -->
  @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['route'=>'agregarespecialidadrh', 'method'=>'POST','class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('txtid',$codigo,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbespecialidad', 'Especialidad',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('v_especialidad',null,['class'=>'form-control pull-right','placeholder'=>'Especialidad','required']) !!}
        {!! Form::hidden('estado','1') !!}
      </div>
    </div>                                    
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('listaespecialidadrh')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection