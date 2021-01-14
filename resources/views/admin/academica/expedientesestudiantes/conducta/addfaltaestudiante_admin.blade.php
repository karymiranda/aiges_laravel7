@extends('admin.menuprincipal')
@section('tittle', 'Administración Académica/Expediente Académico/Conducta/Faltas')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>EXPEDIENTE ESTUDIANTIL / REGISTRO DE FALTAS</Strong></h3>
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
    {!! Form::open(['route'=>'agregaractivo', 'method'=>'POST','class'=>'form-horizontal']) !!}
       
        
        <div class="form-group"> 
          {!! Form::label('lbcod', 'NIE *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('v_nie',null,['class'=>'form-control pull-right','id'=>'id_codigo','placeholder'=>'Código de activo','required','readonly']) !!}
          </div> 
        </div>
     
        <div class="form-group">                 
          {!! Form::label('lbdesc', 'Estudiante *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('v_nombre',null,['class'=>'form-control pull-right','placeholder'=>' Nombre del estudiante','required']) !!}
          </div>
</div><!--fin form group-->
          <div class="form-group">
                {!! Form::label('rubro', 'Tipo falta',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('tipo_falta',['menosgrave'=>'Menos grave','grave'=>'Grave','muygrave'=>'Muy grave'],null,['class'=>'form-control','id'=>'seccion_id','required'])!!}
                </div>
            </div>

      
        <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('descripcion_falta',null,['class'=>'form-control pull-right']) !!}
          </div>
        </div>
    
    <div class="form-group"> 
          {!! Form::label('lbvidautil', 'Sanciones aplicadas',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('sanciones_aplicadas',null,['class'=>'form-control pull-right']) !!}
          </div>
        </div>
       
      </div>
  
    <div class="box-footer" align="right">                
      {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
      <a href="{{route('listaexpedientes')}}" class="btn btn-default">Cancelar</a>
    </div>
  {!! Form::close() !!}
</div>
@endsection
