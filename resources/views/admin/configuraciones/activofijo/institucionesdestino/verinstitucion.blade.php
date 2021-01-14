@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Activo Fijo')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>DETALLE INSTITUCION</Strong></h3>
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
    {!! Form::open(['route'=>null, 'method'=>null,'class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('codigo_institucion',$institucion->codigo_institucion,['class'=>'form-control pull-right','placeholder'=>'Código','readonly']) !!}
      </div>
       </div>
         <div class="form-group"> 
      {!! Form::label('lbnombre', 'Nombre',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('nombre_institucion',$institucion->nombre_institucion,['class'=>'form-control pull-right','placeholder'=>'Nombre','readonly']) !!}        
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('desc', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::textarea('descripcion_institucion',$institucion->descripcion_institucion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Descripción','readonly']) !!}
      </div> 
       </div>
         <div class="form-group">                                           
      {!! Form::label('direccion', 'Dirección',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::textarea('direccion',$institucion->direccion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Dirección','readonly']) !!}
      </div>
    </div> 
    <div class="form-group">                                           
      {!! Form::label('lbtel', 'Teléfono',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-phone"></i>
          </div>
          {!! Form::text('telefono',$institucion->telefono,['class'=>'form-control pull-right tel','placeholder'=>'Teléfono','readonly', 'data-mask']) !!}
        </div>
      </div>
       </div>
         <div class="form-group"> 
      {!! Form::label('lbrepre', 'Representante',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('representante',$institucion->representante,['class'=>'form-control pull-right','placeholder'=>'Representante','readonly']) !!}        
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbcorreo', 'Correo',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-envelope"></i>
          </div>
          {!! Form::text('correo',$institucion->correo,['class'=>'form-control pull-right','placeholder'=>'Correo','readonly']) !!}        
        </div>
      </div>                                   
  </div>
  <div class="box-footer" align="right">                
    <a href="{{ route('listainstituciones') }}" class="btn btn-primary"><< Regresar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection