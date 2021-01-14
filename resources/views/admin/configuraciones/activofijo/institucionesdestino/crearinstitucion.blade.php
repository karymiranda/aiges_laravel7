@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Activo Fijo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>AGREGAR INSTITUCION</Strong></h3>
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
    {!! Form::open(['route'=>'agregarinstitucion', 'method'=>'POST','class'=>'form-horizontal']) !!}
    {!! Form::hidden('estado','1') !!}
    <div class="form-group">                                           
      {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('codigo_institucion',null,['class'=>'form-control pull-right','placeholder'=>'Código']) !!}
      </div>
         </div>
         <div class="form-group">
      {!! Form::label('lbnombre', 'Nombre',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('nombre_institucion',null,['class'=>'form-control pull-right','placeholder'=>'Nombre','required']) !!}        
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('desc', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::textarea('descripcion_institucion',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Descripción']) !!}
      </div> 
      </div>
         <div class="form-group">                                          
      {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::textarea('direccion',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección','required']) !!}
      </div>
    </div> 
    <div class="form-group">                                           
      {!! Form::label('lbtel', 'Teléfono',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-phone"></i>
          </div>
          {!! Form::text('telefono',null,['class'=>'form-control pull-right tel','placeholder'=>'Teléfono','required', 'data-mask']) !!}
        </div>
      </div>
      </div>
         <div class="form-group">
      {!! Form::label('lbrepre', 'Representante',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('representante',null,['class'=>'form-control pull-right','placeholder'=>'Representante','required']) !!}        
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbcorreo', 'Correo',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-envelope"></i>
          </div>
          {!! Form::text('correo',null,['class'=>'form-control pull-right','placeholder'=>'Correo']) !!}        
        </div>
      </div>                                   
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('listainstituciones')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection