@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Recurso Humano')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>TIPO PERMISO</Strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="box-body">
    {!! Form::open(['route'=>'agregartipopermisosrh', 'method'=>'POST','class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbid', 'Código',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('id',$codigo,['class'=>'form-control pull-right','placeholder'=>'Código','disabled','required']) !!}
      </div>
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbtipopermiso', 'Tipo permiso',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('v_descripcion',null,['class'=>'form-control pull-right','placeholder'=>'Tipo permiso','required']) !!}
        {!! Form::hidden('estado','1') !!}
      </div>      
    </div>
    <div class="form-group">                                           
      {!! Form::label('lbmaxanual', 'Máximo Anual',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('i_maxpermisosanual',null,['class'=>'form-control pull-right','placeholder'=>'Permisos Máximos', 'data-inputmask'=>"'alias': 'integer'", 'data-mask','required']) !!}
      </div> 
        </div> 
 <div class="form-group"> 
      {!! Form::label('lbduracion', 'Duración Máxima (Días)',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-4">
        {!! Form::text('i_duracionmax',null,['class'=>'form-control pull-right','placeholder'=>'Duración Máxima','data-inputmask'=>"'alias': 'integer'", 'data-mask','required']) !!}
      </div>                                              
    </div>
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
    <a href="{{route('listatipopermisosrh')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->           
</div>
@endsection